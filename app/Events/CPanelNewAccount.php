<?php

namespace Revenda\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Revenda\CPanel\Conta;

class CPanelNewAccount
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $conta;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Conta $conta)
    {
        $this->conta = $conta;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    /**
     * @return Conta
     */
    public function getConta()
    {
        return $this->conta;
    }
}
