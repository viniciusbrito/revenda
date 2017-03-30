@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if(!isset($conta))
                            <h4 class="alert alert-danger">Ops! Ocorreu algum erro ao tentar recuperar as informações</h4>
                        @else
                            <div class="row">
                                <div class="col-sm-12">Olá</div>
                            </div>
                            <div class="row center-block">
                                <div class="col-sm-12"><button id="senderHash" class="btn btn-primary btn-sm">Gerar Boleto</button></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12"></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

    <script type="text/javascript">

        $('senderHash').on('click',function() {
            var senderHash = PagSeguroDirectPayment.getSenderHash();
        });
    </script>
@endsection
