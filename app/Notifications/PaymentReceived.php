<?php

namespace Revenda\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Revenda\Payment\Pagamento;

class PaymentReceived extends Notification
{
    use Queueable;

    private $pagamento;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Pagamento $pagamento)
    {
        $this->pagamento = $pagamento;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toSlack($notifiable)
    {
        $pgt = $this->pagamento;
        $msg = 'Uma notificação de pagamento foi recebida: '.env('APP_ENV');
        return (new SlackMessage)
            ->success()
            ->content($msg)
            ->attachment(function($attachment) use ($pgt) {
                $attachment->title('Novo Boleto: '.$pgt->referencia)
                    ->fields([
                        'Código:' => $pgt->codigo,
                        'Usuário:' => $pgt->conta->user->email,
                        'Referência:' => $pgt->referencia,
                        'Valor:' => 'R$'.$pgt->conta->pacote->valor,
                        'Status:' => $pgt->status,
                        'Data:' => $pgt->created_at->formatLocalized('%d %B %Y'),
                    ]);
            });

    }
}
