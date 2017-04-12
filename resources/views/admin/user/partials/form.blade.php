
{{csrf_field()}}
<div class="row">
    <div class="col-sm-6">
        <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="nome">Nome:</label>
            <input id="nome" name="nome" value="{{isset($user->nome)? $user->nome : old('nome')}}" class="form-control" type="text"/>

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
            <input id="email" name="email" value="{{isset($user->email)? $user->email : old('email')}}" class="form-control" type="text"/>

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
            <input id="cpf" name="cpf" value="{{isset($user->cpf)? $user->cpf : old('cpf')}}" class="form-control" type="text"/>

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
            <div class="row">
                <div class="col-sm-3">
                    <input id="codigo_area" name="codigo_area" maxlength="2" value="{{isset($user->codigo_area)? $user->codigo_area : old('codigo_area')}}" class="form-control" type="text"/>
                </div>
                <div class="col-sm-9">
                    <input id="telefone" name="telefone" value="{{isset($user->telefone)? $user->telefone : old('telefone')}}" class="form-control" type="text"/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    @if ($errors->has('codigo_area'))
                        <span class="help-block">
                            <strong>{{ $errors->first('codigo_area') }}</strong>
                        </span>
                    @endif
                    @if ($errors->has('telefone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('telefone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group{{ $errors->has('logradouro') ? ' has-error' : '' }}">
            <label for="logradouro">Logradouro:</label>
            <input id="logradouro" name="logradouro" value="{{isset($user->endereco->logradouro)? $user->endereco->logradouro : old('logradouro')}}" class="form-control" type="text"/>

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
            <input id="numero" name="numero" value="{{isset($user->endereco->numero)? $user->endereco->numero : old('numero')}}" class="form-control" type="text"/>

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
            <input id="complemento" name="complemento" value="{{isset($user->endereco->complemento)? $user->endereco->complemento : old('complemento')}}" class="form-control" type="text"/>

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
            <input id="cep" name="cep" value="{{isset($user->endereco->cep)? $user->endereco->cep : old('cep')}}" class="form-control" type="text"/>

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
            <input id="bairro" name="bairro" value="{{isset($user->endereco->bairro)? $user->endereco->bairro : old('bairro')}}" class="form-control" type="text"/>

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
            <input id="cidade" name="cidade" value="{{isset($user->endereco->cidade)? $user->endereco->cidade : old('cidade')}}" class="form-control" type="text"/>

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
            <input id="estado" name="estado" value="{{isset($user->endereco->estado)? $user->endereco->estado : old('estado')}}" class="form-control" type="text"/>

            @if ($errors->has('estado'))
                <span class="help-block">
                    <strong>{{ $errors->first('estado') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
