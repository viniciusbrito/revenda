<?php

namespace Revenda\Listeners;

use Revenda\Events\PaymentNotify;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Revenda\Notifications\InvoiceCreated;
use Revenda\Notifications\PaymentReceived;
use Log;

class PaymentSendNotify
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
            $pagamento = $event->getPagamento();
            $pagamento->notify(new PaymentReceived($pagamento));
        }
    }
}
