<?php

namespace Revenda\Http\Controllers\Payment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Revenda\CPanel\Conta;
use Revenda\Http\Controllers\Controller;
use Revenda\Payment\Pagseguro;

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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $conta = null;

        if(Cache::has(Auth::user()->id))
            $conta = Cache::get(Auth::user()->id);

        return view('user.pagamento')->with(['conta' => $conta]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $conta = null;

        if(Cache::has(Auth::user()->id))
            $conta = Cache::get(Auth::user()->id);
        elseif(isset($request->idConta))
            $conta = Conta::findOrFail($request->idConta);
        else
            return view('user.pagamento');

        $pagamento = new Pagseguro();
        $retorno = $pagamento->criaPagamentoBoleto(Auth::user(), $conta, $request->senderHash);
        if(!$retorno)
            return view('user.pagamento')->with(['conta' => $conta]);

        $link = str_replace('print.jhtml', 'download_pdf.jhtml', (string)$retorno->getPaymentLink());
        $conta->status_id = 2;
        $conta->save();
        return redirect($link);
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
