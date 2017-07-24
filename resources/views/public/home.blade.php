@extends('public.app')

@section('content')

    <div id="domains" style="background-color:#f8f8f8; margin-top: 50px; padding-top:2%; height:130px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <h5>Encontre o seu novo nome de domínio. Digite seu nome ou palavras-chave abaixo para verificar a disponibilidade.</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="input-group input-group-sm">
                        <input id="input-search-domain" type="text" class="form-control" placeholder="Encontre seu novo nome de domínio ...">
                            <span class="input-group-btn">
                                <button class="btn btn-lg btn-success" type="button"><i class="glyphicon glyphicon-search"></i> Pesquisar domínio</button>
                            </span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="plans" style="background-color:#009500; margin-top: 0; padding-top:5%; height:500px; box-shadow: 0px -2px 5px #009500;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <div class="row">
                        <div class="col-sm-12">
                            <h3 style="color: #fff">HOSPEDAGEM DE SITES</h3>
                            <h1 style="color: #fff">ESCOLHA JÁ O SEU PLANO</h1>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 5%;">
                        <div class="col-sm-3 col-sm-offset-2">
                            <div class="panel">
                                <div class="panel-body text-center" style="box-shadow: 1px 1px 10px;">
                                    <h3>PLANO<br/>BÁSICO</h3>
                                    <H4>R$ 9.90/mês</H4>
                                    <button class="btn btn-lg btn-block btn-warning"><i class="glyphicon glyphicon-shopping-cart"></i> Contratar</button>
                                    <br/>
                                    <p>1 site hospedado</p>
                                    <p>25 GB de espaço de armazenamento *</p>
                                    <p>10 contas de e-mail</p>
                                    <p>Certificado SSL grátis</p>
                                    <p>1 base de dados MySQL</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="panel">
                                <div class="panel-body text-center" style="box-shadow: 1px 1px 10px;">
                                    <h3>PLANO<br/>INTERMEDIÁRIO</h3>
                                    <H4>R$ 19.90/mês</H4>
                                    <button class="btn btn-lg btn-block btn-warning"><i class="glyphicon glyphicon-shopping-cart"></i> Contratar</button>
                                    <br/>
                                    <p>2 site hospedado</p>
                                    <p>100 GB de espaço de armazenamento *</p>
                                    <p>40 contas de e-mail</p>
                                    <p>Certificado SSL grátis</p>
                                    <p>2 bases de dados MySQL</p>
                                </div>
                              </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="panel">
                                <div class="panel-body text-center" style="box-shadow: 1px 1px 10px;">
                                    <h3>PLANO<br/>AVANÇADO</h3>
                                    <H4>R$ 49.90/mês</H4>
                                    <button class="btn btn-lg btn-block btn-warning"><i class="glyphicon glyphicon-shopping-cart"></i> Contratar</button>
                                    <br/>
                                    <p>Sites hospedado ilimitados</p>
                                    <p>Espaço de armazenamento ilimitado</p>
                                    <p>Contas de e-mail ilimitadas</p>
                                    <p>Certificado SSL grátis</p>
                                    <p>Bases de dados MySQL ilimitadas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="" style="background-color:#f8f8f8; margin-top: 0; height:380px;"></div>
@endsection
