<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class PublishToTopicCommand extends Command
{
    protected $signature = 'mqtt:publish
                            {topic=toggle/CC:50:E3:09:E5:3A : toggle/MAC_ADDR}
                            {--s|silence : Silenciar mas manter ativado}';

    protected $description = 'Command description';

    public function handle(): void
    {
        $msg = "toggle\0";
        if ($this->option('silence')) {
            $msg = "silenciar\0";
        }
        $topic = $this->argument('topic');
        $this->info("Enviando $msg para $topic");
        MQTT::connection()->publish($topic, $msg, qualityOfService: 0, retain: true);
    }
}
