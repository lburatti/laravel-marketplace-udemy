<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class UserRegisteredEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        // dados usados
        $this->user = $user;
    }

    public function build()
    {
        // onde construimos a mensagem que será enviada
        return $this
            ->subject('Conta criada com sucesso!') // assunto do email
            ->replyTo('lburatti89@gmail.com') // pra quem usuário irá responder
            ->view('emails.user-registered');
            // ->with(['user' => $this->user]);
    }
}
