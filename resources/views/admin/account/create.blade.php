@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {!! Breadcrumbs::render('admin.account.create', $user) !!}
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">Escolher o pacote</h3></div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="{{ route('admin.account.store', $user->id) }}" method="POST" id="account-form">

                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('dominio') ? ' has-error' : '' }}">

                                        <label for="dominio">Seu Dominio:</label>

                                        <div class="input-group">
                                            <span class="input-group-addon" id="addon1">http://</span>
                                            <input type="url" id="dominio" name="dominio" value="{{ old('dominio') }}" class="form-control" required aria-describedby="addon1"/>
                                        </div>

                                        @if ($errors->has('dominio'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('dominio') }}</strong>
                                                </span>
                                        @endif

                                    </div>
                                </form>
                            </div>
                        </div>

                        <hr/>

                        @if ($errors->has('idPacote'))
                            <div class="form-group has-error">
                                <span class="help-block">
                                <strong>{{ $errors->first('idPacote') }}</strong>
                            </span>
                            </div>
                        @endif

                        @foreach($pacotes as $pacote)
                            <div class="row">
                                <div class="col-sm-9 col-xs-8">
                                    <div class="col-sm-4 col-xs-12">
                                        {{$pacote->nome}}
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        Descrição do pacote!
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        R$ {{$pacote->valor}} / {{$pacote->periodo}}
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-3 text-center">
                                    <button type="submit"
                                            class="btn btn-primary btn-sm"
                                            onclick="comprar({{$pacote->idPacote}})">
                                        Comprar
                                    </button>
                                </div>
                            </div>
                            <hr/>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        comprar = function(id) {
            event.preventDefault();
            let form = document.getElementById('account-form');
            let idPacote = document.createElement('input');
            idPacote.type = 'hidden';
            idPacote.name = 'idPacote';
            idPacote.value = id;
            form.append(idPacote);
            form.submit();
        }
    </script>
@endsection
