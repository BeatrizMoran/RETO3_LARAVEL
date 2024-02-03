<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;

class ClienteCreadoNotification extends Notification
{
    use Queueable;

    private $cliente;

    public function __construct($cliente)
    {
        $this->cliente = $cliente;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('¡Hola ' . $this->cliente->nombre . '!')
            ->line('Te damos la bienvenida a Killer. A continuación, encontrarás tus credenciales de acceso. Es importante que mantengas esta información en un lugar seguro y no la compartas.')
            ->line('Nombre: ' . $this->cliente->nombre)
            ->line('Email: ' . $this->cliente->email)
            ->line('Código de Cliente: ' . Crypt::decrypt($this->cliente->codigo_cliente))
            ->action('Acceder a mi Cuenta', url('/'))
            ->line('Si tienes alguna pregunta o necesitas asistencia, no dudes en contactarnos. Estamos aquí para ayudarte.')
            ->line('Gracias por confiar en nosotros.');
    }
}
