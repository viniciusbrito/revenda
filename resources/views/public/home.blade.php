@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            @foreach(Revenda\CPanel\Pacote::all() as $pacote)
                                <div class="col-sm-4 col-xs-12">
                                    <div class="jumbotron">
                                        <strong>{{$pacote->nome}}</strong><br/>
                                        <strong>Valor: R$ {{$pacote->valor}}</strong><br/>
                                        <a href="{{route('client.account.create')}}" class="btn btn-sm btn-primary">Comprar</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
