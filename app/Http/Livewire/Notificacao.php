<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;


class Notificacao extends Component
{
    public $shouldShow = false;
    public $userId = 1;
    public $mensagem;

    public function mount($userId = 1)
    {
        $this->userId = $userId;
    }

    public function getListeners()
    {
        return [
            "echo-private:App.Models.User.{$this->userId},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated" => 'notifyNew',
            "echo:canal-alarme,EventoTeste" => "notifyNew"
        ];
    }

    public function notifyNew($data)
    {
        $this->shouldShow = true;
        $this->mensagem = $data;
    }

    public function render()
    {
        return view('livewire.notificacao');
    }
}
