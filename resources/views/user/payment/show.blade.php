@extends('user.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Breadcrumbs::render('client.payment.show', $pagamento) !!}
                @if(isset($message))
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                {{$message}}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Código:</strong> {{$pagamento->codigo}}</li>
                            <li class="list-group-item"><strong>Referência:</strong> {{$pagamento->referencia}}</li>
                            <li class="list-group-item"><strong>Status:</strong> {{$pagamento->status}}</li>
                            <li class="list-group-item"><strong>Conta:</strong> <a target="_blank" href="http://{{$pagamento->conta->dominio}}">{{$pagamento->conta->dominio}}</a></li>
                            <li class="list-group-item"><strong>Usuário:</strong> {{$pagamento->conta->user->nome}}</li>
                        </ul>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{route('client.account.show', $pagamento->conta->idConta)}}" class="btn btn-sm btn-primary">Continuar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
