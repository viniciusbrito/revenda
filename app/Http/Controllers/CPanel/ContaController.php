<?php

namespace Revenda\Http\Controllers\CPanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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
        $conta->status_id = 1;
        $conta->pacote_id = $pkt->idPacote;
        $user = Auth::user();
        $conta = $user->contas()->save($conta);

        Cache::forget($user->id);
        Cache::put($user->id, $conta, 60);

        if($user->endereco) {
            return redirect()->route('client.payment.create');
        }
        return redirect()->route('client.address.create');
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

            if($conta->status_id == 1) {
                Cache::forget(Auth::user()->id);
                Cache::put(Auth::user()->id, $conta, 60);
                return redirect()->route('client.payment.create');
            }
            return response()->json($conta);
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
