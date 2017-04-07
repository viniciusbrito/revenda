@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-sm-offset-1">
                {!! Breadcrumbs::render('admin.account.show', $conta) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-sm-5 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Informações da conta</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Dominio:</strong> <a target="_blank" href="http://{{$conta->dominio}}">{{$conta->dominio}}</a>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6"><strong>Pacote:</strong> {{$conta->pacote->nome}}</div>
                                    <div class="col-sm-6 text-right"><a class="btn btn-xs btn-default" href="#">Alterar pacote</a></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <strong>Usuário:</strong> {{$conta->usuario}}
                            </li>
                            <li class="list-group-item">
                                <strong>Senha:</strong> {{$conta->senha}}
                            </li>
                            <li class="list-group-item">
                                <strong>Status:</strong> {{$conta->status()}}
                            </li>
                            <li class="list-group-item">
                                <strong>Criado em:</strong> {{$conta->created_at->format('d/m/Y - h:i:s')}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Data da próxima conbrança:</strong> {{$conta->prox_pagamento->format('d/m/Y')}}
                    </li>
                </ul>
                <div class="row">
                    @if(count($conta->pagamentos))
                        <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Status do último pagamento gerado</h3>
                            </div>
                            <div class="panel-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>Código:</strong> {{$conta->pagamentos()->orderBy('created_at', 'desc')->first()->codigo}}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Referência:</strong> {{$conta->pagamentos()->orderBy('created_at', 'desc')->first()->referencia}}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Status:</strong> {{$conta->pagamentos()->orderBy('created_at', 'desc')->first()->status()}}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Data Referência:</strong> {{$conta->pagamentos()->orderBy('created_at', 'desc')->first()->data->format('d/m/Y')}}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Criado em:</strong> {{$conta->pagamentos()->orderBy('created_at', 'desc')->first()->created_at->format('d/m/Y - H:i:s')}}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Última atualização:</strong> {{$conta->pagamentos()->orderBy('created_at', 'desc')->first()->updated_at->format('d/m/Y - H:i:s')}}
                                    </li>
                                </ul>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-6">
                                        <form method="POST" action="{{route('admin.payment.update', [$conta->idConta, $conta->pagamentos()->orderBy('created_at', 'desc')->first()->idPagamento])}}">
                                            {{csrf_field()}}
                                            {{method_field('PUT')}}
                                            <input class="btn btn-sm btn-info"  type="submit" id="atualizar" name="submit" value="Atualizar"/>
                                        </form>
                                    </div>
                                    <div class="col-sm-6 col-xs-6 text-right">
                                        <a class="btn btn-sm btn-primary" href="{{route('admin.payment.index', $conta->idConta)}}">Ver todos</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 tex-center">
                            <div class="form-group">
                                <a class="btn btn-lg btn-block btn-success {{(!count($conta->pagamentos) || $conta->prox_pagamento->subDay(5)->isToday() || $conta->prox_pagamento->subDay(5)->isPast())? ''  : 'disabled'}}"
                                   href="{{route('admin.payment.create', $conta->idConta)}}">
                                    Gerar Novo Boleto
                                </a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
