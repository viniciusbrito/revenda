<?php

namespace Revenda\Http\Controllers\Admin\Client;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Revenda\Client\User;
use Revenda\CPanel\Conta;
use Revenda\CPanel\Pacote;
use Revenda\Http\Controllers\Controller;

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

        $username = $this->makeUsername($user);

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
     * @param User $user
     * @return mixed|string
     */
    private function makeUsername(User $user)
    {
        $i = 1;
        do {
            $username = strtolower(explode(' ', $user->nome)[0]);
            $aux = count($user->contas) + $i;
            $username = $username.'h'.$aux;
            $username = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
            $i++;
        } while(!$this->usernameIsValid($user));
        return $username;
    }

    /**
     * @param string $n
     * @return bool
     */
    private function usernameIsValid($n)
    {
        return Conta::where('usuario', $n)->first()? false : true;
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
