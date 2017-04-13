<?php

namespace Revenda\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Revenda\CPanel\Conta;
use Revenda\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contas = Conta::paginate(5);
        return view('user.home')->with(['contas' => $contas]);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nome' => 'required|min:5|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'cpf' => 'required|max:16|unique:users,cpf,'.$id,
            'codigo_area' => 'required|min:2',
            'telefone' => 'required|min:8',
            'logradouro' => 'required|min:2',
            'numero' => 'required',
            'bairro' => 'required|min:3',
            'cep' => 'required|min:9|max:9',
            'cidade' => 'required|min:4',
            'estado' => 'required|min:2',
            'complemento' => 'string|nullable',
        ]);

        $dados = $request->all();
        $dados['telefone'] = $dados['codigo_area'].' '.$dados['telefone'];

        $user = Auth::user();
        $user = DB::transaction(function() use($dados, $user) {
            $user->update($dados);
            if($user->endereco) {
                $endereco = $user->endereco;
                $endereco->fill($dados);
                $endereco->update();
            }
            else {
                $user->endereco()->save(new Endereco($dados));
            }
            return $user;
        }, 3);

        return redirect()->route('client.edit', $user->id);
    }
}
