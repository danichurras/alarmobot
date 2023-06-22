<?php

namespace App\Listeners;

use App\Events\MqttMessageReceived;
use App\Models\Alarme;
use App\Models\Ativacao;
use App\Models\Disparo;
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
        $mensagem = json_encode($event->message);
        Log::info("Subscribe no topic $event->topic retornou uma mensagem $mensagem.");

        $alarme = Alarme::where('mac_esp', $event->message->id)->first();
        $ativacao = $alarme->ativacaos()->latest()->first();
        Disparo::create([
            'hora_disparo' => $event->message->triggerTime,
            'ativacao_id' => $ativacao->id
        ]);
        $ativacao->update(['disparo' => true]);
    }
}
