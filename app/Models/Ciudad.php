<?php
// Modelo Ciudad: representa ciudades disponibles para vuelos
// Se usa como origen y destino en rutas aéreas

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Administra nombres, códigos IATA y país
class Ciudad extends Model
{
    use HasFactory;

    // Nombre de la tabla (explícito)
    protected $table = 'ciudades';

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre',
        'codigo_iata',
        'pais',
    ];

    // Vuelos donde esta ciudad es ORIGEN
    public function vuelosOrigen()
    {
        return $this->hasMany(Vuelo::class, 'origen_id');
    }

    // Vuelos donde esta ciudad es DESTINO
    public function vuelosDestino()
    {
        return $this->hasMany(Vuelo::class, 'destino_id');
    }
}
