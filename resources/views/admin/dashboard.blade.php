@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-sm-offset-1">
            {!! Breadcrumbs::render('admin.dashboard') !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Bem vindo, <strong>{{Auth::user()->nome}}.</strong>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <p><a class="btn btn-primary btn-sm" href="{{route('admin.user.create')}}">Novo Usuario</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <table class="table table-responsive table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th colspan="2">Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->nome}}</td>
                                            <td>{{$user->email}}</td>
                                            <td><a class="btn btn-primary btn-sm" href="{{route('admin.user.show', $user->id)}}">Ver</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Pagamentos a serem enviados
                </div>

                <div class="panel-body">
                    {{--<div class="row">
                        <div class="col-sm-12 text-right">
                            <p><a class="btn btn-primary btn-sm" href="#">Enviar todos</a></p>
                        </div>
                    </div>--}}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <ul class="list-group">
                                @foreach($contas as $conta)
                                    @if(!$conta->temPagamento())
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-8 col-xs-6">
                                                    <strong>Nome:</strong> {{ $conta->user->nome }} <br/>
                                                    <strong>Dominio:</strong> <a target="_blank" href="//{{ $conta->dominio }}">{{ $conta->dominio }}</a><br/>
                                                    <strong>Valor:</strong> R$ {{ $conta->pacote->valor }} <br/>
                                                    <strong>Prox. Pgt:</strong> {{ $conta->prox_pagamento->format('d/m/Y') }}
                                                </div>
                                                <div class="col-sm-4 col-xs-6 text-center">
                                                    <div class="form-group">
                                                        <a class="btn btn-block btn-sm btn-default" href="{{route('admin.account.show', [$conta->user->id, $conta->idConta])}}">Ver conta</a>
                                                    </div>
                                                    <div class="form-group">
                                                        <form id="payment-store-form" action="{{route('admin.payment.store', $conta->idConta)}}" method="POST" onsubmit="enviarDados()">
                                                            {{csrf_field()}}
                                                            <button id="senderHash" class="btn btn-sm btn-block btn-primary">Gerar Boleto</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(env('PAGSEGURO_ENV') == 'production')
    <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
@else
    <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
@endif

<script type="text/javascript">

    enviarDados = function()
    {
        event.preventDefault();
        let form = document.getElementById("payment-store-form");
        let senderHash = document.createElement('input');
        senderHash.type = 'hidden';
        senderHash.name = 'senderHash';
        senderHash.value = PagSeguroDirectPayment.getSenderHash();;
        form.append(senderHash);
        form.submit();
    }
</script>
@endsection
