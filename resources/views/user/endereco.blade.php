@extends('user.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Endereço</h3>
                    </div>

                    <div class="panel-body">

                        <form novalidate action="{{route('client.address.store')}}" method="POST">
                            {{csrf_field()}}
                            @if(isset($conta))
                                <input type="hidden" name="idConta" value="{{$conta->idConta}}"/>
                            @endif
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('rua') ? ' has-error' : '' }}">
                                        <label for="rua">Rua:</label>
                                        <input type="text" id="rua" name="rua" value="{{ old('rua') }}" class="form-control" required/>

                                        @if ($errors->has('rua'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('rua') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group{{ $errors->has('numero') ? ' has-error' : '' }}">
                                        <label for="numero">Numero:</label>
                                        <input type="text" id="numero" name="numero" value="{{ old('numero') }}" class="form-control" required/>

                                        @if ($errors->has('numero'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('numero') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('bairro') ? ' has-error' : '' }}">
                                        <label for="bairro">Bairro:</label>
                                        <input type="text" id="bairro" name="bairro" value="{{ old('bairro') }}" class="form-control" required/>

                                        @if ($errors->has('bairro'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('bairro') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group{{ $errors->has('cep') ? ' has-error' : '' }}">
                                        <label for="cep">CEP:</label>
                                        <input type="text" id="cep" name="cep" value="{{ old('cep') }}" class="form-control" required/>

                                        @if ($errors->has('cep'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cep') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('complemento') ? ' has-error' : '' }}">
                                        <label for="complemento">Complemento:</label>
                                        <input type="text" id="complemento" name="complemento" value="{{ old('complemento') }}" class="form-control"/>

                                        @if ($errors->has('complemento'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('complemento') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('cidade') ? ' has-error' : '' }}">
                                        <label for="cidade">Cidade:</label>
                                        <input type="text" id="cidade" name="cidade" value="{{ old('cidade') }}" class="form-control" required/>

                                        @if ($errors->has('cidade'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cidade') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                                        <label for="estado">Estado:</label>
                                        <input type="text" id="estado" name="estado" value="{{ old('estado') }}" class="form-control" required/>

                                        @if ($errors->has('estado'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('estado') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="submit" id="submit" name="submit" value="Enviar" class="btn btn-sm btn-primary"/>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
