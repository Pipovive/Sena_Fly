<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModeloAvion extends Model
{
    protected $table = 'modelos_avion';

    protected $fillable = [
        'nombre',
        'capacidad_total',
    ];
}
