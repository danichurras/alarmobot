<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\Exceptions\MqttClientException;
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
        try {
            $mqtt = MQTT::connection();
            $this->info('Conexao bem sucedida. Publicando mensagem...');
            $mqtt->publish('some/topic', 'bar', 2); // QoS 2
            $mqtt->loop(true, true);

            $mqtt->disconnect();
        } catch (MqttClientException $e) {
            $this->error($e->getMessage());
            return -1;
        }
        
        $this->info('Mensagem publicada.');
        return 0;
    }
}
