<?php

namespace Revenda\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Revenda\Events\PaymentNotify' => [
            'Revenda\Listeners\PaymentUpdate',
            'Revenda\Listeners\AccountUpdate',
            'Revenda\Listeners\PaymentSendNotify',
        ],
        'Revenda\Events\CPanelNewAccount' => [
            'Revenda\Listeners\CreateCPanelNewAccount',
        ],
        'Revenda\Events\AccountStatusUpdate' => [
            'Revenda\Listeners\CPanelAccountUpdate',
            'Revenda\Listeners\AccountStatusUpdateNofify'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
