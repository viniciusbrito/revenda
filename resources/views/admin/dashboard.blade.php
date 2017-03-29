@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Bem vindo, <strong>{{Auth::user()->name}}.</strong>
                </div>

                <div class="panel-body">
                    Last login was...
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
