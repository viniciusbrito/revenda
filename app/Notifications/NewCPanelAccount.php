<?php

namespace Revenda\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Revenda\CPanel\Conta;

class NewCPanelAccount extends Notification
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
        return ['slack', 'mail'];
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
            ->subject('Dados de acesso')
            ->greeting("Olá {$this->conta->user->nome}!")
            ->line('A seguir os dados para acesso ao painel de contrele do seu novo site.')
            ->action('Painel de controle', 'http://'.$this->conta->dominio.'/cpanel/')
            ->line('Usuário: '.$this->conta->usuario)
            ->line('Senha: '.$this->conta->senha);
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
        $msg = 'Um nova conta foi criada no CPanel! Ambiente: '.env('APP_ENV');
        return (new SlackMessage)
            ->success()
            ->content($msg)
            ->attachment(function($attachment) use ($conta) {
                $attachment->title('Nova Conta: '.$conta->dominio)
                    ->fields([
                        'User:' => $conta->user->email,
                        'Pacote:' => $conta->pacote->nome,
                        'Criado em:' => $conta->created_at->formatLocalized('%d %B %Y')
                    ]);
            });
    }
}
