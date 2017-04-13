<?php

namespace Revenda\Http\Controllers\Client\Payment;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Revenda\Events\PaymentNotify;
use Revenda\Http\Controllers\Controller;
use Revenda\CPanel\Conta;
use Revenda\Notifications\InvoiceCreated;
use Revenda\Payment\Pagamento;
use Revenda\Payment\PagseguroBoleto;

class PaymentController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idConta, Request $request)
    {
        $conta = Conta::findOrFail($idConta);

        $filter = isset($request->filter)? $request->filter : 'all';

        $status = ['all' => [1,2,3], 'pgt' => [3], 'agp' => [1]];

        $pagamentos = $conta->pagamentos()->whereIn('status', $status[$filter])->orderBy('created_at', 'desc')->paginate(2);

        return view('user.payment.index')->with(['conta' => $conta, 'pagamentos' => $pagamentos, 'filter' => $filter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idConta)
    {
        $conta = Conta::findOrFail($idConta);

        return view('user.payment.create')->with(['conta' => $conta]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($idConta, Request $request)
    {
        $conta = Conta::findOrFail($idConta);
        $user = Auth::user();
        $transacao = new PagseguroBoleto();

        $resposta = $transacao->gerar($user, $conta, $request->senderHash);

        if(!$resposta)
            return view('client.payment.create')->with(['conta' => $conta]);

        /*
         * NEED BE REFACTORED
        */
        $boletoLink = $resposta->getPaymentLink();
        $boletoDownload = str_replace('print.jhtml', 'download_pdf.jhtml', $boletoLink);
        $boletoCode = $resposta->getCode();
        $boletoStorePath = storage_path().'/boletos/'.$boletoCode.'.pdf';
        file_put_contents($boletoStorePath, fopen($boletoDownload, 'r'));

        $pagamento = DB::transaction(function() use($conta, $resposta) {
            return $conta->pagamentos()
                ->save(new Pagamento([
                    'codigo'  => $resposta->getCode(),
                    'referencia'   => $resposta->getReference(),
                    'status' => $resposta->getStatus(),
                    'data' => $conta->prox_pagamento,
                ]));
        }, 5);

        $pagamento->notify(new InvoiceCreated($pagamento, $boletoStorePath));

        return redirect()->route('client.payment.show', [$pagamento->conta->idConta, $pagamento->idPagamento]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idConta, $idPagamento)
    {
        $pgt = Pagamento::findOrFail($idPagamento);
        return view('user.payment.show', [
            'pagamento' => $pgt,
            'message'   => "Boleto enviado para o email: {$pgt->conta->user->email}"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $conta, $pagamento)
    {
        $pagamento = Pagamento::findOrFail($pagamento);

        $boleto = new PagseguroBoleto();
        $resposta = $boleto->buscar($pagamento->codigo);

        /**********************
         * NEED BE REFACTORED *
         **********************/
        if(!$resposta)
            return '';

        $transacao = [
            'tipo' => $request['notificationType'],
            'email' => $resposta->getSender()->getEmail(),
            'codigo' => $resposta->getCode(),
            'status' => $resposta->getStatus(),
            'data' => Carbon::createFromFormat("Y-m-d\TH:i:s.uP", $resposta->getLasteventdate())->toDateTimeString()
        ];
        /*Fires event of payment notify*/
        event(new PaymentNotify($pagamento, $transacao));

        //return redirect()->route('admin.account.show', [$pagamento->conta->user->id, $pagamento->conta->idConta]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
