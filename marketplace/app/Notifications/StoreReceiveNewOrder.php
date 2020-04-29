<?php

namespace App\Notifications;

use Hamcrest\Type\IsNumeric;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class StoreReceiveNewOrder extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    // canal de envio da notificação (salvar no DB + enviar email + sms)
    public function via($notifiable)
    {
        // return ['database', 'mail', 'nexmo']; VERIFICAR ERRO NO FROM 
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Novo pedido recebido!')
                    ->greeting('Olá vendedor, tudo bem?')
                    ->line('Você recebeu um novo pedido em sua loja!')
                    ->action('Ver pedido', route('orders.my'));
    }

    public function toArray($notifiable)
    {
        return [
            // essa mensagem será salva na coluna data
            'message' => 'Você tem um novo pedido solicitado'
        ];
    }

    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
                ->content('Você recebeu um novo pedido em nosso site')
                ->from('5511995210970')
                ->unicode();
    }
}
