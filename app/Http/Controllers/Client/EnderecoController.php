<?php

namespace Revenda\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Revenda\Client\Endereco;
use Revenda\CPanel\Conta;
use Revenda\Http\Controllers\Controller;

class EnderecoController extends Controller
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
    public function create(Request $request)
    {
        $conta  = null;

        if(Cache::has(Auth::user()->id))
            $conta = Cache::get(Auth::user()->id);

        return view('user.endereco')->with(['conta' => $conta]);
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
            'rua' => 'required|min:2',
            'numero' => 'required',
            'bairro' => 'required|min:3',
            'cep' => 'required|min:9|max:9',
            'cidade' => 'required|min:4',
            'estado' => 'required|min:2',
            'ponto_referencia' => 'string|nullable',
        ]);

        $user = Auth::user();
        $address = new Endereco($request->all());
        $user->endereco()->save($address);

        if(isset($request->idConta))
            return redirect()->route('client.payment.create');

        return redirect()->route('client.enderco.create')->withInput()->with(['flash_message' => 'Endereco salvo com sucesso']);
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
