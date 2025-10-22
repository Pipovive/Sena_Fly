<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Aereopuerto extends Model
{
     use HasFactory;

    protected $table = 'aeropuertos';

    protected $fillable = [
        'nombre',
        'codigo',
        'ciudad',
        'pais'
    ];

    public function vuelosOrigen()
    {
        return $this->hasMany(Vuelo::class, 'aeropuerto_origen_id');
    }

    public function vuelosDestino()
    {
        return $this->hasMany(Vuelo::class, 'aeropuerto_destino_id');
    }
}
