<?php

namespace Revenda\Listeners;

use Illuminate\Support\Facades\Log;
use Revenda\Events\CPanelNewAccount;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Revenda\Notifications\NewCPanelAccount;
use Revenda\CPanel\WHM;

class CreateCPanelNewAccount
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
     * @param  CPanelNewAccount  $event
     * @return void
     */
    public function handle(CPanelNewAccount $event)
    {
        $conta = $event->getConta();

        $resultado = $this->whm->criaConta($conta);

        Log::info('CPANEL LOG', $resultado);
        
        if($resultado['codigo'])
            $conta->notify(new NewCPanelAccount($conta));

        return $resultado['codigo'];
    }
}
