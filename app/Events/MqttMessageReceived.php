<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class MqttMessageReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $topic;
    public mixed $message;

    /**
     * Create a new event instance.
     */
    public function __construct(string $topic, string $message)
    {
        $this->topic = $topic;
        $message_object = json_decode($message);
        $message_object->triggerTime = new Carbon($message_object->triggerTime);
        $this->message = $message_object;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
