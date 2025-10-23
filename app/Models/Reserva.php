<?php
// Este archivo define el modelo Reserva que representa las reservas de vuelos en el sistema
// Gestiona toda la información relacionada con las reservas y sus relaciones con otros modelos

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Modelo para manejar las reservas de vuelos realizadas por los usuarios
class Reserva extends Model
{
     use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'reservas';

      protected $fillable = [
        'user_id',
        'codigo_reserva',
        'vuelo_id',
        'nombre_titular',
        'apellido_titular',
        'email_titular',
        'telefono_titular',
        'estado',
        'cantidad_pasajeros',
        'total_pagado',
    ];

    // Relación con el vuelo asociado a esta reserva
    public function vuelo()
    {
        return $this->belongsTo(Vuelo::class);
    }

    // Relación con el usuario que realizó la reserva
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con los pasajeros incluidos en esta reserva
    public function pasajeros()
    {
        return $this->hasMany(Pasajero::class);
    }
    
    // Relación con el asiento seleccionado para esta reserva
    public function asiento()
    {
        return $this->belongsTo(Asiento::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

}
