<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Informações da conta</h3>
    </div>
    <div class="panel-body">
        <ul class="list-group">
            <li class="list-group-item">
                <strong>Dominio:</strong> <a target="_blank" href="http://{{$conta->dominio}}">{{$conta->dominio}}</a>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-sm-6 col-xs-6"><strong>Pacote:</strong> {{$conta->pacote->nome}}</div>
                    <div class="col-sm-6 col-xs-6 text-right"><a class="btn btn-xs btn-default" href="#">Alterar pacote</a></div>
                </div>
            </li>
            <li class="list-group-item">
                <strong>Usuário:</strong> {{$conta->usuario}}
            </li>
            <li class="list-group-item">
                <strong>Senha:</strong> {{$conta->senha}}
            </li>
            <li class="list-group-item">
                <strong>Status:</strong> {{$conta->status}}
            </li>
            <li class="list-group-item">
                <strong>Criado em:</strong> {{$conta->created_at->format('d/m/Y - h:i:s')}}
            </li>
        </ul>
    </div>
</div>