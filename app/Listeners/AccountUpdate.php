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
        /*Fires notify on slack for payment received*/
        if ($event->getDados()['status'] == 3) {

            $conta = $event->getPagamento()->conta;
            if ($conta->nova_conta) {
                $conta->status_id = 2;
                $conta->nova_conta = 0;
            }
            $conta->prox_pagamento = $event->getPagamento()->data->addMonth(1);
            $conta->save();
        }
    }
}
