<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disparo extends Model
{
    use HasFactory;

    protected $table = 'disparos';
    
    protected $primary_key = 'id';

    public $timestamps = true;

    protected $fillable = [
        'hora_disparo', 'ativacao_id', 'silenciado'
    ];

    public function ativacao()
    {
        return $this->belongsTo(Ativacao::class);
    }

    public function getSilenciouAttribute()
    {
        if ($this->silenciado) {
            return 'Sim';
        } else {
            return 'Não';
        }
    }
}