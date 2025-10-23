<?php
// Modelo Aereopuerto: representa aeropuertos para operar vuelos
// Usado como origen y destino en rutas con referencia a ciudades

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aereopuerto extends Model
{
     use HasFactory;

    // Nombre de la tabla
    protected $table = 'aeropuertos';

    // Campos asignables
    protected $fillable = [
        'nombre',
        'codigo',
        'ciudad',
        'pais'
    ];

    // Vuelos con este aeropuerto como ORIGEN
    public function vuelosOrigen()
    {
        return $this->hasMany(Vuelo::class, 'aeropuerto_origen_id');
    }

    // Vuelos con este aeropuerto como DESTINO
    public function vuelosDestino()
    {
        return $this->hasMany(Vuelo::class, 'aeropuerto_destino_id');
    }
}
