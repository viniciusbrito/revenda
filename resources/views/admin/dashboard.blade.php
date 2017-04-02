@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {!! Breadcrumbs::render('admin.dashboard') !!}
            <div class="panel panel-default">
                <div class="panel-heading">
                    Bem vindo, <strong>{{Auth::user()->nome}}.</strong>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <p><a class="btn btn-primary btn-sm" href="{{route('admin.user.create')}}">Novo Usuario</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th colspan="2">Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->nome}}</td>
                                            <td>{{$user->email}}</td>
                                            <td><a class="btn btn-primary btn-sm" href="{{route('admin.user.show', $user->id)}}">Ver</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
