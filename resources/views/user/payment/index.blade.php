@extends('user.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {!! Breadcrumbs::render('client.payment.index', $conta) !!}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-8 col-xs-6">
                                <h3 class="panel-title">Lista de pagamentos</h3>
                            </div>
                            <div class="col-sm-4 col-xs-6 text-right">
                                <form id="filtrar-form" name="filtrar-form" action="{{ route('client.payment.index', $conta->idConta) }}" method="GET">
                                    <select onchange="document.getElementById('filtrar-form').submit();" class="form-control input-sm" name="filter" id="filter">
                                        <option {{(isset($filter) && $filter == 'all')? 'selected' : ''}} value="all">Todos os pagamentos</option>
                                        <option {{(isset($filter) && $filter == 'pgt')? 'selected' : ''}}  value="pgt">Pagamentos confirmados</option>
                                        <option {{(isset($filter) && $filter == 'agp')? 'selected' : ''}}  value="agp">Aguardando pagamento</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @foreach($pagamentos as $pagamento)
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <td colspan="2"><strong>Código:</strong> {{$pagamento->codigo}}</td>
                                </tr>
                                <tr>
                                    <td >
                                        <strong>Referência:</strong> {{$pagamento->referencia}}
                                    </td>
                                    <td>
                                        <strong>Status:</strong> {{$pagamento->status()}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Data Referência:</strong> {{$pagamento->data->format('d/m/Y')}}</td>
                                    <td><strong>Criado em:</strong> {{$pagamento->created_at->format('d/m/Y - H:i:s')}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Última atualização:</strong> {{$pagamento->updated_at->format('d/m/Y - H:i:s')}}</td>
                                    <td class="text-right">
                                        <form method="POST" action="{{route('client.payment.update', [$pagamento->conta->idConta, $pagamento->idPagamento])}}">
                                            {{csrf_field()}}
                                            {{method_field('PUT')}}
                                            <input class="btn btn-sm btn-info"  type="submit" id="atualizar" name="submit" value="Atualizar"/>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                {!! $pagamentos->appends(['filter'=>$filter])->links() !!}
            </div>
        </div>
    </div>
@endsection
