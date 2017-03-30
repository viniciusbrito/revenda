@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-10">
                            Meus Pacotes
                        </div>
                        <div class="col-sm-2 left">
                            <a href="{{ route('client.account.create') }}" class="btn btn-xs btn-block btn-primary">Pacote</a>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    @if(count($contas))
                        <ul class="list-group">
                            @foreach($contas as $conta)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <strong>{{ $conta->dominio }}</strong><br/>
                                            <strong>{{ $conta->pacote->nome }}</strong><br/>
                                            <small>Vencimento todo dia {{ $conta->created_at->format('d') }}</small>
                                            <small>Status: {{ $conta->status() }}</small>
                                        </div>
                                        <div class="col-sm-3">
                                            <a href="{{ route('client.account.show', $conta->idConta) }}" class="btn btn-default btn-xs">Gerenciar</a><br/>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        {{ $contas->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
