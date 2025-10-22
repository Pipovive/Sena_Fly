<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si es "ciudades")
    protected $table = 'ciudades';

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre',
        'codigo_iata',  // Ejemplo: BOG, MDE, PEI
        'pais',
    ];

    // ✅ Relaciones ---------------------

    // Una ciudad puede ser origen de muchos vuelos
    public function vuelosOrigen()
    {
        return $this->hasMany(Vuelo::class, 'origen_id');
    }

    // Una ciudad puede ser destino de muchos vuelos
    public function vuelosDestino()
    {
        return $this->hasMany(Vuelo::class, 'destino_id');
    }
}
