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
    ];

    // Relación con ciudad de origen
    public function origen()
    {
        return $this->belongsTo(Ciudad::class, 'origen_id');
    }

    // Relación con ciudad de destino
    public function destino()
    {
        return $this->belongsTo(Ciudad::class, 'destino_id');
    }

    // Relación con avión
    public function avion()
    {
        return $this->belongsTo(Avion::class);
    }

    public function reservas()
{
    return $this->hasMany(Reserva::class);
}
}
