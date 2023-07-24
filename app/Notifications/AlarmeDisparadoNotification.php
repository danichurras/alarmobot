<?php

namespace App\Notifications;

use App\Models\Disparo;
use Illuminate\Broadcasting\InteractsWithBroadcasting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AlarmeDisparadoNotification extends Notification implements ShouldQueue, ShouldBroadcast
{
    use Queueable, InteractsWithBroadcasting;

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
        return ['database', 'broadcast'];
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

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'hora' => $this->disparo->hora_disparo,
            'alarme' => $this->disparo->ativacao->alarme->nome
        ]);
    }
}
