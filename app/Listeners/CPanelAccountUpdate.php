<?php

namespace Revenda\Listeners;

use Revenda\Events\AccountStatusUpdate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Revenda\CPanel\WHM;

class CPanelAccountUpdate
{

    private $whm;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->whm = app(WHM::class);
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

        if($conta->status_id == 2)
            $r = $this->whm->reativaConta($conta);
        elseif($conta->status_id == 3)
            $r = $this->whm->desativaConta($conta);

        return $r;
    }
}
