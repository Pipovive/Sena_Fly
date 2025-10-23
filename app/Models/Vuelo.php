<?php
// Modelo Vuelo: representa un vuelo programado con origen, destino y avión
// Administra precios, horarios y sus relaciones con reservas

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Clase que gestiona los vuelos disponibles y sus atributos
class Vuelo extends Model
{
    use HasFactory;

    // Tabla asociada
    protected $table = 'vuelos';

    // Campos que se pueden asignar
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

    // Ciudad de origen del vuelo
    public function origen()
    {
        return $this->belongsTo(Ciudad::class, 'origen_id');
    }

    // Ciudad de destino del vuelo
    public function destino()
    {
        return $this->belongsTo(Ciudad::class, 'destino_id');
    }

    // Avión asignado a este vuelo
    public function avion()
    {
        return $this->belongsTo(Avion::class);
    }

    // Reservas realizadas para este vuelo
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
