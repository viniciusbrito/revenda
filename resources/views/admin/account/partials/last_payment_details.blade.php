<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Status do último pagamento gerado</h3>
    </div>
    <div class="panel-body">
        <ul class="list-group">
            <li class="list-group-item">
                <strong>Código:</strong> {{$conta->pagamentos()->orderBy('created_at', 'desc')->first()->codigo}}
            </li>
            <li class="list-group-item">
                <strong>Referência:</strong> {{$conta->pagamentos()->orderBy('created_at', 'desc')->first()->referencia}}
            </li>
            <li class="list-group-item">
                <strong>Status:</strong> {{$conta->pagamentos()->orderBy('created_at', 'desc')->first()->status}}
            </li>
            <li class="list-group-item">
                <strong>Data Referência:</strong> {{$conta->pagamentos()->orderBy('created_at', 'desc')->first()->data->format('d/m/Y')}}
            </li>
            <li class="list-group-item">
                <strong>Criado em:</strong> {{$conta->pagamentos()->orderBy('created_at', 'desc')->first()->created_at->format('d/m/Y - H:i:s')}}
            </li>
            <li class="list-group-item">
                <strong>Última atualização:</strong> {{$conta->pagamentos()->orderBy('created_at', 'desc')->first()->updated_at->format('d/m/Y - H:i:s')}}
            </li>
        </ul>
        <div class="row">
            <div class="col-sm-6 col-xs-6">
                <form method="POST" action="{{route('admin.payment.update', [$conta->idConta, $conta->pagamentos()->orderBy('created_at', 'desc')->first()->idPagamento])}}">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <input class="btn btn-sm btn-info"  type="submit" id="atualizar" name="submit" value="Atualizar"/>
                </form>
            </div>
            <div class="col-sm-6 col-xs-6 text-right">
                <a class="btn btn-sm btn-primary" href="{{route('admin.payment.index', $conta->idConta)}}">Ver todos</a>
            </div>
        </div>
    </div>
</div>