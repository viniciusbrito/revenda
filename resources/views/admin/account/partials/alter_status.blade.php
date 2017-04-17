<form id="accountUpdateForm" action="{{route('admin.account.update', [$conta->user->id, $conta->idConta])}}" method="POST">

    {{ method_field('PUT') }} {{ csrf_field() }}

    @if($conta->status_id == 2)
        <input type="hidden" name="status_id" value="3"/>
        <input type="submit" id="accountUpdate" name="submit" value="Suspender conta" class="btn btn-lg btn-block btn-warning" />

    @elseif($conta->status_id == 3)
        <input type="hidden" name="status_id" value="2"/>
        <input type="submit" id="accountUpdate" name="submit" value="Reativar conta" class="btn btn-lg btn-block btn-primary" />
    @endif

</form>