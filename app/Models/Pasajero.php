<?php
// Modelo Pasajero: representa a cada persona asociada a una reserva
// Calcula automáticamente si es menor y se relaciona con asiento y reserva

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Clase para gestionar la información de pasajeros
class Pasajero extends Model
{
    use HasFactory;

    // Tabla asociada
    protected $table = 'pasajeros';

    // Campos asignables
    protected $fillable = [
        'reserva_id', 'nombre', 'apellido', 'genero', 'fecha_nacimiento',
        'tipo_documento', 'numero_documento', 'email', 'telefono',
        'es_menor', 'asiento_id'
    ];

    // La reserva a la que pertenece el pasajero
    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }

    // El asiento asignado a este pasajero
    public function asiento()
    {
        return $this->belongsTo(Asiento::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pasajero) {
            $pasajero->es_menor = Carbon::parse($pasajero->fecha_nacimiento)->age < 18;
        });
    }
}
