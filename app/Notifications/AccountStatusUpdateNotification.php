<?php

namespace Revenda\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Revenda\CPanel\Conta;

class AccountStatusUpdateNotification extends Notification
{
    use Queueable;

    private $conta;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Conta $conta)
    {
        $this->conta = $conta;
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
        $conta = $this->conta;

        if($conta->status_id == 2)
            $msg = 'Uma conta foi reativada: '.env('APP_ENV');
        elseif($conta->status_id == 3)
            $msg = 'Uma conta foi destivada: '.env('APP_ENV');

        $slack = (new SlackMessage)
            ->warning()
            ->content($msg)
            ->attachment(function($attachment) use ($conta) {
                $attachment->title('')
                    ->fields([
                        'User:' => $conta->user->email,
                        'Pacote:' => $conta->pacote->nome,
                        'Criado em:' => $conta->created_at->formatLocalized('%d %B %Y'),
                        'Atualizado em:' => $conta->updated_at->formatLocalized('%d %B %Y')
                    ]);
            });

        if(!env('production'))
            $slack->to('#dev');
        return $slack;

    }
}
