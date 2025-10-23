<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asiento extends Model
{
    use HasFactory;

    protected $fillable = ['avion_id', 'codigo', 'clase', 'disponible'];

    public function avion()
    {
        return $this->belongsTo(Avion::class);
    }
    
    public function pasajero()
    {
        return $this->hasOne(Pasajero::class);
    }

    public function reserva()
    {
        return $this->hasOne(Reserva::class);
    }
}
