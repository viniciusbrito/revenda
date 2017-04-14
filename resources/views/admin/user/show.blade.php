@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-sm-offset-1">
                {!! Breadcrumbs::render('admin.user.show', $user) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-6 col-xs-6 col-lg-6">
                                <h3 class="panel-title">Informações pessoais</h3>
                            </div>
                            <div class="col-sm-6 col-xs-6 col-lg-6 text-right">
                                <a class="btn btn-primary btn-xs" href="{{route('admin.user.edit', $user->id)}}">Editar</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>Nome:</strong> {{$user->nome}}</li>
                                    <li class="list-group-item"><strong>Email:</strong> {{$user->email}}</li>
                                    <li class="list-group-item"><strong>CPF:</strong> {{$user->cpf}}</li>
                                    <li class="list-group-item"><strong>Telefone:</strong> {{$user->codigo_area}} {{$user->telefone}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                @if(!$user->endereco)
                                    <a href="{{route('admin.user.edit', $user->id)}}"><p class="alert alert-warning text-center">Esse usuário precisa ser atualizado.<br/>Clique aqui para atualizar</p></a>
                                @else
                                    <ul class="list-group">
                                        <li class="list-group-item"><strong>Logradouro:</strong> {{$user->endereco->logradouro}}</li>
                                        <li class="list-group-item"><strong>Numero:</strong> {{$user->endereco->numero}}</li>
                                        <li class="list-group-item"><strong>Complemento:</strong> {{$user->endereco->complemento}}</li>
                                        <li class="list-group-item"><strong>CEP:</strong> {{$user->endereco->cep}}</li>
                                        <li class="list-group-item"><strong>Bairro:</strong> {{$user->endereco->bairro}}</li>
                                        <li class="list-group-item"><strong>Cidade:</strong> {{$user->endereco->cidade}}</li>
                                        <li class="list-group-item"><strong>Estado:</strong> {{$user->endereco->estado}}</li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-lg-6">
                                <h3 class="panel-title">Pacotes Contratados</h3>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-lg-6 text-right">
                                <a class="btn btn-primary btn-xs" href="{{route('admin.account.create', $user->id)}}">Add Pacote</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="list-group">
                                    @foreach($user->contas as $conta)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <strong>Dominio:</strong> {{$conta->dominio}}<br/>
                                                    <strong>Pacote:</strong> {{$conta->pacote->nome}}<br/>
                                                    <small>Vencimento todo dia {{$conta->prox_pagamento->format('d')}}</small>
                                                </div>
                                                <div class="col-sm-5">
                                                    <a class="btn btn-default btn-block" href="{{route('admin.account.show',[$user->id, $conta->idConta])}}">Gerenciar</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

        </div>
    </div>
@endsection
