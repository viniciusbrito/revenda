<?php

namespace Revenda\Http\Controllers\Admin\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Revenda\CPanel\Conta;
use Revenda\Http\Controllers\Controller;
use Revenda\Mail\SendInvoice;
use Revenda\Notifications\InvoiceCreated;
use Revenda\Payment\Pagamento;
use Revenda\Payment\PagseguroBoleto;

class PaymentController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $conta = Conta::findOrFail($id);
        return view('admin.payment.create')->with(['conta' => $conta]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $conta = Conta::findOrFail($id);
        $user = $conta->user;
        $transacao = new PagseguroBoleto();

        $resposta = $transacao->gerar($user, $conta, $request->senderHash);

        if(!$resposta)
            return view('admin.payment.create')->with(['conta' => $conta]);

        /*
         * NEED BE REFACTORED
        */
        $boletoLink = $resposta->getPaymentLink();
        $boletoDownload = str_replace('print.jhtml', 'download_pdf.jhtml', $boletoLink);
        $boletoCode = $resposta->getCode();
        $boletoStorePath = storage_path().'/boletos/'.$boletoCode.'.pdf';
        file_put_contents($boletoStorePath, fopen($boletoDownload, 'r'));

        Mail::to($user)->send(new SendInvoice($user, $conta, $boletoStorePath));

        $pagamento = DB::transaction(function() use($conta, $resposta) {
            return $conta->pagamentos()
                ->save(new Pagamento([
                    'codigo'  => $resposta->getCode(),
                    'referencia'   => $resposta->getReference(),
                    'status' => $resposta->getStatus(),
            ]));
        }, 5);

        $pagamento->notify(new InvoiceCreated($pagamento));

        return view('admin.payment.create')->with([
            'idUser'    => $user->id,
            'idConta'   => $conta->idConta,
            'pagamento' => $pagamento,
            'message'   => "Boleto enviado para o email: {$user->email}"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
