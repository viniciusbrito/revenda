<?php

namespace Revenda\Listeners;

use Revenda\Events\PaymentNotify;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountUpdate
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
        $conta = $event->getPagamento()->conta;
        if($conta->nova_conta) {
            $conta->status_id = 2;
            $conta->nova_conta = 0;
        }
        $conta->prox_pagamento = $conta->prox_pagamento->addMonth(1);
        $conta->save();
    }
}
