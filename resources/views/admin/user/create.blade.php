@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {!! Breadcrumbs::render('admin.user.create') !!}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Novo Usuário</h3>
                    </div>

                    <div class="panel-body">
                        <form action="{{route('admin.user.store')}}" method="POST">
                            @include('admin.user.partials.form')
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
