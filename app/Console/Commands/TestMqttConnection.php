<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class TestMqttConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-mqtt-connection';

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
        $this->info('Teste iniciado...');
        /** @var \PhpMqtt\Client\Contracts\MqttClient $mqtt */
        $mqtt = MQTT::connection();
        $this->info('Conexao bem sucedida. Publicando mensagem...');
        // $mqtt->publish('some/topic', 'foo', 1); // QoS 1
        $mqtt->publish('some/topic', 'bar', 2, true); // QoS 2 Retain the message
        $mqtt->loop(true, true);

        // MQTT::publish('some/topic', 'Hello World!'); // QoS 0
        $this->info('Mensagem publicada.');
        return 0;
    }
}
