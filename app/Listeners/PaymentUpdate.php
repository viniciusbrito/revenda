<?php

namespace Revenda\Listeners;

use Carbon\Carbon;
use Revenda\Events\PaymentNotify;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentUpdate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PaymentNotify  $event
     * @return void
     */
    public function handle(PaymentNotify $event)
    {
        $pagamento = $event->getPagamento();
        $dados = $event->getDados();
        $pagamento->status = $dados['status'];
        $pagamento->updated_at = $dados['data'];
        $pagamento->save();
    }
}
