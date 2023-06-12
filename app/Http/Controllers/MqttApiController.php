<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;

class MqttApiController extends Controller
{
    public function publish(Request $request) {
        $validatedRequest = $request->validate(['topic' => 'required', 'message' => 'required']);
        
        $topic = $validatedRequest['topic'];
        $message = $validatedRequest['message'];

        $mqtt = MQTT::connection();
        $mqtt->publish($topic, $message, 2, true); // QoS 2 Retain the message
        $mqtt->loop(true, true);

        return response()->json();
    }
}
