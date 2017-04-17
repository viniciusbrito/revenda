<?php

namespace Revenda\Listeners;

use Revenda\Events\AccountStatusUpdate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Revenda\Notifications\AccountStatusUpdateNotification;


class AccountStatusUpdateNofify
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
     * @param  AccountStatusUpdate  $event
     * @return void
     */
    public function handle(AccountStatusUpdate $event)
    {
        $conta = $event->getConta();

        $conta->notify(new AccountStatusUpdateNotification($conta));
    }
}
