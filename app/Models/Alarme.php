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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
