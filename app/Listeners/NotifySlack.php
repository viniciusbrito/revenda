<?php

namespace Revenda\Listeners;

use Revenda\Events\PaymentNotify;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Revenda\Notifications\InvoiceCreated;
use Revenda\Notifications\PaymentReceived;
use Log;

class NotifySlack
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
        $pagamento->notify(new PaymentReceived($pagamento));
    }
}
