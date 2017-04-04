<?php

namespace Revenda\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Revenda\Payment\Pagamento;

class PaymentNotify
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $pagamento;
    private $dados;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Pagamento $pagamento, $dados)
    {
        $this->pagamento = $pagamento;
        $this->dados = $dados;
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
     * @return Pagamento
     */
    public function getPagamento()
    {
        return $this->pagamento;
    }

    /**
     * @return mixed
     */
    public function getDados()
    {
        return $this->dados;
    }

}
