<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    use HasFactory;

    protected $table = 'vuelos';

    protected $fillable = [
        'origen_id',
        'destino_id',
        'avion_id',
        'fecha',
        'hora_salida',
        'hora_llegada',
        'precio',
        'estado',
    ];

    public function origen()
    {
        return $this->belongsTo(Ciudad::class, 'origen_id');
    }

    public function destino()
    {
        return $this->belongsTo(Ciudad::class, 'destino_id');
    }

  
    public function avion()
    {
        return $this->belongsTo(Avion::class);
    }

    public function reservas()
{
    return $this->hasMany(Reserva::class);
}
}
