<?php

namespace Revenda\Http\Controllers\Client\CPanel;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Revenda\Http\Controllers\Controller;
use Revenda\CPanel\Conta;
use Revenda\CPanel\Pacote;
use Revenda\Client\User;

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
        return view('user.account.create')->with(['pacotes' => Pacote::all()]);
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

        $user = Auth::user();

        $username = $this->makeUsername($user);

        $conta = new Conta();
        $conta->dominio = $request->dominio;
        $conta->usuario = $username;
        $conta->senha = str_random(8);
        $conta->status_id = 1;
        $conta->pacote_id = $pkt->idPacote;
        $conta->prox_pagamento = Carbon::now();
        $conta = $user->contas()->save($conta);

        if($user->endereco) {
            return redirect()->route('client.payment.create', $conta->idConta);
        }
        return redirect()->route('client.address.create');
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
    public function show($id)
    {
        if(!$id) {
            return response(404);
        }
        else {
            $conta = Conta::findOrFail($id);

            /*if($conta->status_id == 1) {
                Cache::forget(Auth::user()->id);
                Cache::put(Auth::user()->id, $conta, 60);
                return redirect()->route('client.payment.create', $conta->idConta);
            }
            return response()->json($conta);*/
            return view('user.account.show', ['conta' => $conta]);
        }
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
