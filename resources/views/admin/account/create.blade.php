@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nova Conta</h3>
                    </div>

                    <div class="panel-body">
                        @if(isset($user))
                            {{$user}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
