<?php

namespace Revenda\Http\Controllers\Admin\Client;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Revenda\Client\User;
use Revenda\CPanel\Conta;
use Revenda\CPanel\Pacote;
use Revenda\Events\AccountStatusUpdate;
use Revenda\Http\Controllers\Controller;
use Revenda\CPanel\WHM;

class AccountController extends Controller
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
        $user = User::findOrFail($id);
        if($user->endereco) {
            $pacotes = Pacote::all();
            return view('admin.account.create')->with(['user' => $user, 'pacotes' => $pacotes]);
        }
        return redirect()->route('admin.user.edit', $user->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        if(!$id) {
            return abort(404);
        }
        $user = User::findOrFail($id);

        $this->validate($request, [
            'dominio' => 'required|unique:contas,dominio',
            'idPacote'  =>  'required|exists:pacotes,idPacote'
        ]);

        $pkt = Pacote::findOrFail($request->idPacote);

        $whm = app(WHM::class);
        $username = $whm->criaNomeUsuario($user);

        /*
         * NEED A REPOSITORY PATTERN
         * */
        $conta = new Conta();
        $conta->dominio = $request->dominio;
        $conta->usuario = $username;
        $conta->senha = str_random(8);
        $conta->status_id = 1;
        $conta->pacote_id = $pkt->idPacote;
        $conta->prox_pagamento = Carbon::now();
        $conta = $user->contas()->save($conta);

        return redirect()->route('admin.payment.create', $conta->idConta);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idUser, $idConta)
    {
        if(!$idConta) {
            return abort(404);
        }
        $conta = Conta::findOrFail($idConta);
        return view('admin.account.show', ['conta' => $conta]);

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
    public function update(Request $request, $idUser, $idConta)
    {
        $conta = Conta::findOrFail($idConta);
        $statusA = $conta->status_id;

        $conta->fill($request->all());
        $conta->save();

        if($conta->status_id != $statusA)
            event(new AccountStatusUpdate($conta));

        return redirect()->route('admin.account.show', [$conta->user->id, $conta->idConta]);
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
