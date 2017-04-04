@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {!! Breadcrumbs::render('admin.payment.create', $conta) !!}
                <div class="panel panel-default">
                    <div class="panel-heading">Novo Pagamento</div>

                    <div class="panel-body">
                        @if(!isset($conta))
                            <h4 class="alert alert-danger">Ops! Ocorreu algum erro ao tentar recuperar as informações</h4>
                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="alert alert-info">
                                        A solicitação de pagamento será enviada para o email: <strong>{{$conta->user->email}}</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-center">
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
