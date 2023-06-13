<?php

namespace App\Http\Controllers;

use App\Events\MqttMessageReceived;
use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;

class MqttApiController extends Controller
{
    /**
     * Api para publicar uma mensagem em algum topico.
     */
    public function publish(Request $request)
    {
        $validatedRequest = $request->validate(['topic' => 'required', 'message' => 'required']);

        $topic = $validatedRequest['topic'];
        $message = $validatedRequest['message'];

        $mqtt = MQTT::connection();
        $mqtt->publish($topic, $message, 2);
        $mqtt->loop(true, true);

        return response()->json();
    }

    /**
     * Api para se inscrever em algum topico.
     */
    public function subscribe(Request $request)
    {
        $validatedRequest = $request->validate([
            'topic' => 'required',
        ]);

        $topic = $validatedRequest['topic'];

        $mqtt = MQTT::connection();
        $mqtt->subscribe($topic, function (string $topic, string $message) {
            MqttMessageReceived::dispatch($topic, $message);
        }, 2);
        $mqtt->loop(true, true);

        return response()->json();
    }
}
