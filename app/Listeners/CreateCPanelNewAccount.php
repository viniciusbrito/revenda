<?php

namespace Revenda\Listeners;

use Revenda\Events\CPanelNewAccount;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Revenda\Notifications\NewCPanelAccount;

class CreateCPanelNewAccount
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
     * @param  CPanelNewAccount  $event
     * @return void
     */
    public function handle(CPanelNewAccount $event)
    {
        $conta = $event->getConta();
        /*Criar a conta*/

        /*
         *Chamar as funções para criação da conta no CPanel
         */

        /*SE(conta for criada no cpanel com sucesso)*/
            $conta->notify(new NewCPanelAccount($conta));
    }
}
