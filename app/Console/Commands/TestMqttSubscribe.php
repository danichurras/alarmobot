<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\Exceptions\MqttClientException;
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
        try {
            $mqtt = MQTT::connection();
            $helper = $this;
            $mqtt->subscribe('some/topic', function (string $topic, string $message) use ($helper) {
                $helper->message("Received QoS level 2 message on topic [$topic]: $message");
            }, 1);
            $mqtt->loop(true, true);
            $mqtt->disconnect();
        } catch (MqttClientException $e) {
            $this->error($e->getMessage());
            return -1;
        }

        return 0;
    }
}
