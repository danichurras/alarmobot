<?php

namespace App\Notifications;

use App\Models\Disparo;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AlarmeDisparadoNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Disparo $disparo;

    /**
     * Create a new notification instance.
     */
    public function __construct(Disparo $disparo)
    {
        $this->disparo = $disparo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'canal-alarme'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'hora' => $this->disparo->hora_disparo,
            'alarme' => $this->disparo->ativacao->alarme->nome
        ];
    }
}
