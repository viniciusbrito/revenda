@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {!! Breadcrumbs::render('admin.payment.index', $pagamentos->first()->conta) !!}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Lista de pagamentos</h3>
                    </div>
                    <div class="panel-body">
                        @foreach($pagamentos as $pagamento)
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <td><strong>Código:</strong> {{$pagamento->codigo}}</td>
                                    <td class="text-right">
                                        <form method="POST" action="{{route('admin.payment.update', [$pagamento->conta->idConta, $pagamento->idPagamento])}}">
                                            {{csrf_field()}}
                                            {{method_field('PUT')}}
                                            <input class="btn btn-sm btn-info"  type="submit" id="atualizar" name="submit" value="Atualizar"/>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Referência:</strong> {{$pagamento->referencia}}
                                    </td>
                                    <td>
                                        <strong>Status:</strong> {{$pagamento->status()}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Criado em:</strong> {{$pagamento->created_at->format('d/m/Y - H:i:s')}}</td>
                                    <td><strong>Última atualização:</strong> {{$pagamento->updated_at->format('d/m/Y - H:i:s')}}</td>
                                </tr>
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                {!! $pagamentos->links() !!}
            </div>
        </div>
    </div>
@endsection
