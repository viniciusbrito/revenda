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
                        <h3 class="panel-title">{{$conta->dominio}} - {{$conta->pacote->nome}}</h3>
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
                @if(count($conta->pagamentos) <= 0)
                    <a class="btn btn-sm btn-primary" href="{{route('admin.payment.create', $conta->idConta)}}">Pagamento</a>
                @else
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
                            <strong>Criado em:</strong> {{$conta->pagamentos()->orderBy('created_at', 'desc')->first()->created_at->format('d/m/Y - H:i:s')}}
                        </li>
                        <li class="list-group-item">
                            <strong>Última atualização:</strong> {{$conta->pagamentos()->orderBy('created_at', 'desc')->first()->updated_at->format('d/m/Y - H:i:s')}}
                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-sm-6">
                            <form method="POST" action="{{route('admin.payment.update', [$conta->idConta, $conta->pagamentos()->orderBy('created_at', 'desc')->first()->idPagamento])}}">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <input class="btn btn-sm btn-info"  type="submit" id="atualizar" name="submit" value="Atualizar"/>
                            </form>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a class="btn btn-sm btn-primary" href="{{route('admin.payment.index', $conta->idConta)}}">Ver todos</a>
                        </div>
                    </div>
                </div>
            </div>
                @endif
        </div>
        </div>
    </div>
@endsection
