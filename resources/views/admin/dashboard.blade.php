@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Bem vindo, <strong>{{Auth::user()->nome}}.</strong>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <p><a class="btn btn-primary btn-sm" href="{{route('admin.account.create')}}">Novo Conta</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><a class="btn btn-primary btn-sm" href="{{route('admin.user.create')}}">Novo Usuario</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
