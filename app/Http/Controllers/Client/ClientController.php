<?php

namespace Revenda\Http\Controllers\Client;

use Illuminate\Http\Request;
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
}
