<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class TestMqttSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-mqtt-subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       /** @var \PhpMqtt\Client\Contracts\MqttClient $mqtt */
       $mqtt = MQTT::connection();
       $mqtt->subscribe('some/topic', function (string $topic, string $message) {
           echo sprintf('Received QoS level 2 message on topic [%s]: %s', $topic, $message);
       }, 1);
       $mqtt->loop(true, true);

       return 0;
    }
}
