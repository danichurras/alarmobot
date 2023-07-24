<?php

namespace App\Console\Commands;

use App\Events\MqttMessageReceived;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;
use Illuminate\Support\Carbon;
use phpDocumentor\Reflection\Types\True_;
use PhpMqtt\Client\Contracts\MqttClient;
use PhpMqtt\Client\Exceptions\DataTransferException;
use PhpMqtt\Client\Exceptions\InvalidMessageException;
use PhpMqtt\Client\Exceptions\MqttClientException;
use PhpMqtt\Client\Exceptions\ProtocolViolationException;
use PhpMqtt\Client\Exceptions\RepositoryException;
use PhpMqtt\Client\Facades\MQTT;

class SubscribeToTopic extends Command implements Isolatable
{
    public MqttClient $mqtt;
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

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info("Started.");

        $topic = $this->argument('topic');

        $this->info("Tópico setado para: $topic");

        while (true){
            try {
                $this->subscribe($topic);
            } catch (DataTransferException|RepositoryException|MqttClientException|ProtocolViolationException|InvalidMessageException $e) {
            }
            MQTT::clearResolvedInstances();
            unset($this->mqtt);
        }

    }

    /**
     * @throws ProtocolViolationException
     * @throws InvalidMessageException
     * @throws MqttClientException
     * @throws RepositoryException
     * @throws DataTransferException
     */
    public function subscribe($topic): void
    {
        $mqtt_host = config('mqtt-client.connections.default.host');
        $mqtt_port = config('mqtt-client.connections.default.port');
        $this->info("Conectando em $mqtt_host:$mqtt_port...");
        $this->mqtt = MQTT::connection();
        $this->info("Conectado.");

        $this->info("Subscribe no tópico: $topic");

        $this->mqtt->subscribe($topic, function (string $topic, string $message) {
            $this->info("Received QoS level 1 message on topic [$topic]: $message");
            MqttMessageReceived::dispatch($topic, $message);

//            $message_object = json_decode($message);
//            $message_object->triggerTime = Carbon::createFromTimestamp($message_object->triggerTime)->toDayDateTimeString();
//            $message = json_encode($message_object);
            $this->info("Received QoS level 1 message on topic [$topic]: $message");
        }, 1);
        $this->mqtt->loop(true, true);

    }
}
