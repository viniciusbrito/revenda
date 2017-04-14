@extends('user.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {!! Breadcrumbs::render('client.index') !!}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-10">
                            Meus Pacotes
                        </div>
                        <div class="col-sm-2 left">
                            <a href="{{ route('client.account.create') }}" class="btn btn-xs btn-block btn-primary">Add Conta</a>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    @if(count($contas))
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="list-group">
                                    @foreach($contas as $conta)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-9 col-xs-6">
                                                    <strong><a target="_blank" href="//{{ $conta->dominio }}">{{ $conta->dominio }}</a></strong>
                                                    <br/>
                                                    <strong>{{ $conta->pacote->nome }}</strong>
                                                    <br/>
                                                    <small>Vencimento todo dia {{ $conta->created_at->format('d') }}</small>
                                                    <br/>
                                                    <small>Status: {{ $conta->status_id }}</small>
                                                </div>
                                                <div class="col-sm-3 col-xs-6 text-center">
                                                    <a href="{{ route('client.account.show', $conta->idConta) }}" class="btn btn-default btn-block">Gerenciar</a><br/>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                {{ $contas->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
