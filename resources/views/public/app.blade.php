<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}">
    <link rel="shortcut icon" href="https://dottcon.com/_biblioteca/_imagens/favicon.ico" type="image/x-icon"/>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a href="{{ url('/') }}">
                        <img class="navbar-brand" src="https://dottcon.com/_biblioteca/_imagens/imgLogoEC-2.png" alt="Dottcon - Tecnologia & Consultoria"/>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <a class="btn btn-sm btn-success navbar-btn" href="{{ route('register') }}" t><i class="glyphicon glyphicon-plus"></i> <b>Cadastre-se</b></a>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#domains">Domínios</a></li>
                        <li><a href="#plans">Hospedagem</a></li>
                        <li><a href="#contact">Contato</a></li>
                    </ul>
                </div>
            </div>
            {{--GAMBIARRA PARA CORRIGIR--}}
            <div class="progress" style="margin-bottom: 0; height: 2px;">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                    <span class="sr-only">100% Complete</span>
                </div>
            </div>
            {{--GAMBIARRA PARA CORRIGIR--}}
        </nav>

        @yield('content')

        <div id="contact" style=" background-color: #fff; margin-top: 0; padding-top:1%; min-height:80px; box-shadow: 0 -1px 10px #009500;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <img class="img-responsive" src="https://dottcon.com/_biblioteca/_imagens/imgLogoEC-2.png" alt="Dottcon - Tecnologia & Consultoria"/>
                        <small>&copy; {{date('Y')}}</small>
                    </div>

                    <div class="col-sm-2">
                        <small style="font-weight:bold; color: #000;">
                            Rua Goiás, 421 - Centro <br/>
                            CEP 78600-000 <br/>
                            Barra do Garças, MT - Brasil
                        </small>
                    </div>

                    <div class="col-sm-2">
                        <small style="font-weight:bold; color: #000;">(66) 98463-9404<br/>contato&commat;dottcon.com.br</small>
                    </div>

                    <div class="col-sm-1 text-right">
                        <a href="https://fb.com/dottcon"><i style="color: #3b5998" class="fa fa-facebook-official fa-2x" aria-hidden="true"></i></a>
                        &nbsp;
                        <a href="https://plus.google.com/+dottcon"><i style="color: #ea4335" class="fa fa-google-plus-official fa-2x" aria-hidden="true"></i></a>
                    </div>

                    <div class="col-sm-5">
                        <img class="img-responsive" src="https://stc.pagseguro.uol.com.br/public/img/banners/pagamento/avista_estatico_550_70.gif" alt="Logotipos de meios de pagamento do PagSeguro" title="Este site aceita pagamentos com os principais bancos, saldo em conta PagSeguro e boleto.">
                    </div>
                </div>
                <div class="row">

                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ mix('assets/js/app.js') }}"></script>
</body>
</html>
