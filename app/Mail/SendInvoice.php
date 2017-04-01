<?php

namespace Revenda\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Revenda\Client\User;
use Revenda\CPanel\Conta;

class SendInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $conta;
    public $file;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Conta $conta, $file)
    {
        $this->user = $user;
        $this->conta = $conta;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $nome = 'Boleto '.Carbon::now()->formatLocalized('%d %B %Y').'.pdf';
        return $this
            ->from('revenda@dottcon.com', 'Dottcon - Cloud Services')
            ->subject($this->conta->pacote->nome.' Boleto')
            ->view('mail.payment.sendInvoice')
            ->attach($this->file, ['as' => $nome, 'mime' => 'application/pdf']);

    }
}
