<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alarme extends Model
{
    use HasFactory;

    protected $table = 'alarmes';
    
    protected $primary_key = 'id';

    public $timestamps = true;

    protected $fillable = [
        'nome', 'status', 'user_id', 'mac_esp',
    ];

    public function getDisparadoAttribute() {
        if ($this->status === 'ativado') {
            $a = Ativacao::where('alarme_id', '=', $this->id)->latest()->first();

            if($a->disparos->isEmpty()){
                $disparado = false;
            } else {
                $disparo = Disparo::where('ativacao_id', '=', $a->id)->where('silenciado', '=', false)->latest()->first();
                if(isset($disparo)) {
                    $disparado = true;
                } else {
                    $disparado = false;
                }
            }
        } else {
            $disparado = false;
        }

        return $disparado;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ativacaos()
    {
        return $this->hasMany(Ativacao::class);
    }
}
