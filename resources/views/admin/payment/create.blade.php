@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if(isset($message))
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                {{$message}}
                            </div>
                        </div>
                    </div>
                    <hr/>

                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Referência:</strong> {{$pagamento->referencia}}</li>
                                <li class="list-group-item"><strong>Código:</strong> {{$pagamento->codigo}}</li>
                                <li class="list-group-item"><strong>Status:</strong> {{$pagamento->status}}</li>
                                <li class="list-group-item"><strong>Conta:</strong> {{$pagamento->conta->dominio}}</li>
                                <li class="list-group-item"><strong>Usuário:</strong> {{$pagamento->conta->user->nome}}</li>
                            </ul>

                        </div>
                    </div>
                    <hr/>

                    <div class="row">
                        <div class="col-sm-12">
                            <a href="{{route('admin.account.show',[$idUser, $idConta])}}" class="btn btn-sm btn-primary">Continuar</a>
                        </div>
                    </div>
                @else
                    <div class="panel panel-default">
                        <div class="panel-heading">Pagamento</div>

                        <div class="panel-body">
                            @if(!isset($conta))
                                <h4 class="alert alert-danger">Ops! Ocorreu algum erro ao tentar recuperar as informações</h4>
                            @else
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form id="payment-store-form" action="{{route('admin.payment.store',$conta->idConta)}}" method="POST" onsubmit="enviarDados()">
                                            {{csrf_field()}}
                                            {{--idConta Redundancia (só p/ garantir) caso perca o cache--}}
                                            <input type="hidden" id="idConta" name="idConta" value="{{$conta->idConta}}"/>
                                            <button id="senderHash" class="btn btn-primary btn-lg">Enviar Boleto</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
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
