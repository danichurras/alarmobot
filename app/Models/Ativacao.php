<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ativacao extends Model
{
    use HasFactory;

    protected $table = 'ativacaos';
    
    protected $primary_key = 'id';

    public $timestamps = true;

    protected $fillable = [
        'data_ativacao', 'data_desativacao', 'disparo', 'alarme_id'
    ];

    public function alarme()
    {
        return $this->belongsTo(Alarme::class);
    }

    public function disparos()
    {
        return $this->hasMany(Disparo::class);
    }

    public function getDisparouAttribute()
    {
        if ($this->disparo) {
            return 'Sim';
        } else {
            return 'Não';
        }
    }
}