<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reserva extends Model
{
     use HasFactory;

    protected $table = 'reservas';

      protected $fillable = [
        'codigo_reserva',
        'vuelo_id',
        'nombre_titular',
        'apellido_titular',
        'email_titular',
        'telefono_titular',
        'estado',
        'cantidad_pasajeros',
        'total_pagado'
    ];

    public function vuelo()
    {
        return $this->belongsTo(Vuelo::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
