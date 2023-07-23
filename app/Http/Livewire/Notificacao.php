<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Livewire\Component;
//use WireUi\Traits\Actions;

class Notificacao extends Component
{
//    use Actions;

    public function getMensagensProperty()
    {
        $mensagens = [];
        foreach (auth()->user()->unreadNotifications as $unreadNotification) {
            $alarme = $unreadNotification['data']['alarme'];
            $hora = Carbon::createFromTimeString($unreadNotification['data']['hora'])->toDayDateTimeString();
            $mensagens[] = "$alarme disparou em $hora";
        }

        return $mensagens;
    }
    public function render()
    {
        return view('livewire.notificacao');
    }
}
