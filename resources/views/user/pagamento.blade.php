@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Pagamento</div>

                    <div class="panel-body">
                        @if(!isset($conta))
                            <h4 class="alert alert-danger">Ops! Ocorreu algum erro ao tentar recuperar as informações</h4>
                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <p>Para finalizar a compra clique em <b>"Gerar Boleto"</b> e efetue o pagamento.</p>
                                    <p>Assim que receber-mos a confirmação do pagamento, você receberá os dados de acesso ao painel de controle do sue site.</p>
                                    <p>Obrigado!</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <form id="payment-store-form" action="{{route('client.payment.store')}}" method="POST" onsubmit="enviarDados()">
                                        {{csrf_field()}}
                                        {{--idConta Redundancia (só p/ garantir) caso perca o cache--}}
                                        <input type="hidden" id="idConta" name="idConta" value="{{$conta->idConta}}"/>
                                        <button id="senderHash" class="btn btn-primary btn-lg">Gerar Boleto</button>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">

                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

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
