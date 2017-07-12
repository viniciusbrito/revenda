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
                    <div class="input-group input-group-lg">
                        <input id="input-search-domain" type="text" class="form-control" placeholder="Encontre seu novo nome de domínio ...">
                            <span class="input-group-btn">
                                <button class="btn btn-lg btn-success" type="button"><i class="glyphicon glyphicon-search"></i> Pesquisar domínio</button>
                            </span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="plans" style="background-color:#5cb85c; margin-top: 0; padding-top:5%; height:500px; box-shadow: 0px -2px 5px #5cb85c;">
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
                                    <H4>R$ 9.90</H4>
                                    <button class="btn btn-lg btn-block btn-warning"><i class="glyphicon glyphicon-shopping-cart"></i> Contratar</button>
                                    <br/>
                                    <p>10 GB Espaço em Disco</p>
                                    <p>1 Domínio Hospedado</p>
                                    <p>Transferência ILIMITADA</p>
                                    <p>Contas de E-Mail ILIMITADAS</p>
                                    <p>Bases MySQL ILIMITADAS</p>
                                    <p>Subdomínios ILIMITADOS</p>
                                    <p>Certificado SSL GRÁTIS</p>
                                    <p>Criador de Sites GRÁTIS</p>
                                    <p>Instalador +430 Apps GRÁTIS</p>
                                    <p>CPU Xeon 1 x 2,4GHz</p>
                                    <p>Memória 10GB (2 Ram + 8 Virt)</p>
                                    <p>Processos Simultâneos 50</p>
                                    <p>Inodes ILIMITADOS</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="panel">
                                <div class="panel-body text-center" style="box-shadow: 1px 1px 10px;">
                                    <h3>PLANO<br/>INTERMEDIÁRIO</h3>
                                    <H4>R$ 19.90</H4>
                                    <button class="btn btn-lg btn-block btn-warning"><i class="glyphicon glyphicon-shopping-cart"></i> Contratar</button>
                                    <br/>
                                    <p>10 GB Espaço em Disco</p>
                                    <p>1 Domínio Hospedado</p>
                                    <p>Transferência ILIMITADA</p>
                                    <p>Contas de E-Mail ILIMITADAS</p>
                                    <p>Bases MySQL ILIMITADAS</p>
                                    <p>Subdomínios ILIMITADOS</p>
                                    <p>Certificado SSL GRÁTIS</p>
                                    <p>Criador de Sites GRÁTIS</p>
                                    <p>Instalador +430 Apps GRÁTIS</p>
                                    <p>CPU Xeon 1 x 2,4GHz</p>
                                    <p>Memória 10GB (2 Ram + 8 Virt)</p>
                                    <p>Processos Simultâneos 50</p>
                                    <p>Inodes ILIMITADOS</p>
                                </div>
                              </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="panel">
                                <div class="panel-body text-center" style="box-shadow: 1px 1px 10px;">
                                    <h3>PLANO<br/>AVANÇADO</h3>
                                    <H4>R$ 39.90</H4>
                                    <button class="btn btn-lg btn-block btn-warning"><i class="glyphicon glyphicon-shopping-cart"></i> Contratar</button>
                                    <br/>
                                    <p>10 GB Espaço em Disco</p>
                                    <p>1 Domínio Hospedado</p>
                                    <p>Transferência ILIMITADA</p>
                                    <p>Contas de E-Mail ILIMITADAS</p>
                                    <p>Bases MySQL ILIMITADAS</p>
                                    <p>Subdomínios ILIMITADOS</p>
                                    <p>Certificado SSL GRÁTIS</p>
                                    <p>Criador de Sites GRÁTIS</p>
                                    <p>Instalador +430 Apps GRÁTIS</p>
                                    <p>CPU Xeon 1 x 2,4GHz</p>
                                    <p>Memória 10GB (2 Ram + 8 Virt)</p>
                                    <p>Processos Simultâneos 50</p>
                                    <p>Inodes ILIMITADOS</p>
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
