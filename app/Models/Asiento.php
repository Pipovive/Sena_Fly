<?php
// Modelo Asiento: representa un asiento dentro de un avión
// Se relaciona con el avión, y opcionalmente con un pasajero y una reserva

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Administra disponibilidad y asignaciones de asientos
class Asiento extends Model
{
    use HasFactory;

    // Campos que se pueden editar
    protected $fillable = ['avion_id', 'codigo', 'clase', 'disponible'];

    // El avión al que pertenece este asiento
    public function avion()
    {
        return $this->belongsTo(Avion::class);
    }
    
    // Pasajero asignado (si existe)
    public function pasajero()
    {
        return $this->hasOne(Pasajero::class);
    }

    // Reserva que pudo asociarse a este asiento (si aplica)
    public function reserva()
    {
        return $this->hasOne(Reserva::class);
    }
}
