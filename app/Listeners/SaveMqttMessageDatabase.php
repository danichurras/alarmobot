<?php

namespace App\Listeners;

use App\Events\MqttMessageReceived;
use App\Models\Alarme;
use App\Models\Disparo;
use App\Notifications\AlarmeDisparadoNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SaveMqttMessageDatabase implements ShouldQueue
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
        Log::debug("Subscribe no topic $event->topic retornou uma mensagem $event->message.");

        $mensagem = json_decode($event->message);
        Log::debug("Mensagem decodificada: " . serialize($mensagem));
        $alarme = Alarme::where('mac_esp', $mensagem->id)->first();
        $ativacao = $alarme->ativacaos()->latest()->first();
        $disparo = Disparo::create([
            'hora_disparo' => Carbon::createFromTimestamp($mensagem->triggerTime),
            'ativacao_id' => $ativacao->id
        ]);
        $ativacao->update(['disparo' => true]);
        $alarme->user->notify(new AlarmeDisparadoNotification($disparo));
    }
}
