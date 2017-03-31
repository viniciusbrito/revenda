@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Novo Usuário</h3>
                    </div>

                    <div class="panel-body">
                        <form action="{{route('admin.user.store')}}" method="POST">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                                        <label for="nome">Nome:</label>
                                        <input id="nome" name="nome" value="{{old('nome')}}" class="form-control" type="text"/>

                                        @if ($errors->has('nome'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nome') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email">Email:</label>
                                        <input id="email" name="email" value="{{old('email')}}" class="form-control" type="text"/>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                                        <label for="cpf">CPF:</label>
                                        <input id="cpf" name="cpf" value="{{old('cpf')}}" class="form-control" type="text"/>

                                        @if ($errors->has('cpf'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cpf') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
                                        <label for="telefone">Telefone:</label>
                                        <input id="telefone" name="telefone" value="{{old('telefone')}}" class="form-control" type="text"/>

                                        @if ($errors->has('telefone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('telefone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('logradouro') ? ' has-error' : '' }}">
                                        <label for="logradouro">Logradouro:</label>
                                        <input id="logradouro" name="logradouro" value="{{old('logradouro')}}" class="form-control" type="text"/>

                                        @if ($errors->has('logradouro'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('logradouro') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('numero') ? ' has-error' : '' }}">
                                        <label for="numero">Numero:</label>
                                        <input id="numero" name="numero" value="{{old('numero')}}" class="form-control" type="text"/>

                                        @if ($errors->has('numero'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('numero') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('complemento') ? ' has-error' : '' }}">
                                        <label for="complemento">Complemento:</label>
                                        <input id="complemento" name="complemento" value="{{old('complemento')}}" class="form-control" type="text"/>

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
                                    <div class="form-group{{ $errors->has('cep') ? ' has-error' : '' }}">
                                        <label for="cep">CEP:</label>
                                        <input id="cep" name="cep" value="{{old('cep')}}" class="form-control" type="text"/>

                                        @if ($errors->has('cep'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cep') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('bairro') ? ' has-error' : '' }}">
                                        <label for="bairro">Bairro:</label>
                                        <input id="bairro" name="bairro" value="{{old('bairro')}}" class="form-control" type="text"/>

                                        @if ($errors->has('bairro'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('bairro') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('cidade') ? ' has-error' : '' }}">
                                        <label for="cidade">Cidade:</label>
                                        <input id="cidade" name="cidade" value="{{old('cidade')}}" class="form-control" type="text"/>

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
                                        <input id="estado" name="estado" value="{{old('estado')}}" class="form-control" type="text"/>

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
                                    <input class="btn btn-primary btn-sm" type="submit" name="cadastrar" value="Cadastrar"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
