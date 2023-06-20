<?php

namespace App\Listeners;

use App\Events\MqttMessageReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SaveMqttMessageDatabase
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MqttMessageReceived $event): void
    {
        Log::info("Subscribe no topic $event->topic retornou uma mensagem $event->message.");
    }
}
