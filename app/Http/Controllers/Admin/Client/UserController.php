<?php

namespace Revenda\Http\Controllers\Admin\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Revenda\Client\Endereco;
use Revenda\Client\User;
use Revenda\Http\Controllers\Controller;

class UserController extends Controller
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
    public function create()
    {
        return view('admin.user.create');
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
            'nome' => 'required|min:5|max:255',
            'email' => 'required|email|max:255|unique:users',
            'cpf' => 'required|max:16|unique:users',
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
        $dados['password'] = Hash::make(str_random(8));

        $user = DB::transaction(function() use($dados) {
            $user = User::create($dados);
            $user->endereco()->save(new Endereco($dados));
            return $user;
        });
        /*
         * NEED SEND AN E-MAIL TO USER WITH THE CREDENTIALS
         * */

        return redirect()->route('admin.account.create', $user->id);
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
