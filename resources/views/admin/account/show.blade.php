@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-sm-offset-1">
                {!! Breadcrumbs::render('admin.account.show', $conta) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-sm-5 col-sm-offset-1">
                <div class="row">
                    <div class="col-sm-12">
                        @include('admin.account.partials.account_info')
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 text-center">
                        @include('admin.account.partials.alter_status')
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Data da próxima conbrança:</strong> {{$conta->prox_pagamento->format('d/m/Y')}}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    @if(count($conta->pagamentos))
                        <div class="col-sm-12">
                            @include('admin.account.partials.last_payment_details')
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
