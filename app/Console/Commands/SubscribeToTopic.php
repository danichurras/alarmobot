<?php

namespace App\Console\Commands;

use App\Events\MqttMessageReceived;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\Facades\MQTT;

class SubscribeToTopic extends Command implements Isolatable
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:subscribe {topic=movimento/iniciado}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Se inscreve em um tópico MQTT e dispara um evento.
                                {topic : O tópico. (default=movimento/iniciado}';

    public $mqtt;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Started.");

        $topic = $this->argument('topic');

        $this->info("Tópico setado para: $topic");

        $this->subscribe($topic);     

        $this->info("Finished.");
    }

    public function subscribe($topic) {
        $mqtt_host = config('mqtt-client.connections.default.host');
        $mqtt_port = config('mqtt-client.connections.default.port');
        $this->info("Conectando em $mqtt_host:$mqtt_port...");
        $this->mqtt = MQTT::connection();
        $this->info("Conectado.");
        
        $this->info("Subscribe no tópico: $topic");
        $this->mqtt->subscribe($topic, function (string $topic, string $message) {
            MqttMessageReceived::dispatch($topic, $message);
            $this->info("Received QoS level 2 message on topic [$topic]: $message");
        }, 2);
        $this->mqtt->loop(true, true);
    }
}
