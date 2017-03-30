<?php

namespace Revenda\Http\Controllers\CPanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Revenda\CPanel\Conta;
use Revenda\Http\Controllers\Controller;
use Revenda\CPanel\Pacote;

class ContaController extends Controller
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
        return view('user.conta')->with(['pacotes' => Pacote::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'idPacote'  =>  'required|exists:pacotes,idPacote',
            'dominio'   =>  'required'
        ]);

        $pkt = Pacote::findOrFail($request->idPacote);

        $username = explode('.', $request->dominio)[0];
        $conta = Conta::where('usuario', $username)->first();
        if($conta)
            return back()->withInput()->withErrors(['dominio' => 'Problemas com usuario']);

        $conta = new Conta();
        $conta->dominio = $request->dominio;
        $conta->usuario = $username;
        $conta->senha = str_random(8);
        $conta->pacote_id = $pkt->idPacote;
        $conta = Auth::user()->contas()->save($conta);

        return view('user.pagamento')->with(['conta' => $conta]);
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
