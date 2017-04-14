<?php

namespace Revenda\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Revenda\Client\User;
use Revenda\CPanel\Conta;
use Revenda\Http\Controllers\Controller;
use Revenda\Payment\Pagamento;

class AdminController extends Controller
{

    function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $pagamentos = Pagamento::where('status', '=', 1)->get();

        $contas = Conta::whereBetween('prox_pagamento', [
            Carbon::now()->format('Y-m-d'),
            Carbon::now()->addDays(7)->format('Y-m-d')
        ])
            ->orderBy('prox_pagamento', 'asc')
            ->get();

        return view('admin.dashboard',[
            'users' => User::all(),
            'contas' => $contas,
            'pagamentos' => $pagamentos
        ]);
    }
}
