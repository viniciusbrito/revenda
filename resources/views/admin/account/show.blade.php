@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$conta->dominio}} - {{$conta->pacote->nome}}
                    </div>

                    <div class="panel-body">
                        @foreach($conta->getAttributes() as $key => $value)
                            {{$key}}: {{$value}}<br/>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
