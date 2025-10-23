<?php
// Modelo ModeloAvion: catálogo de modelos de avión (capacidad, nombre)
// Relaciona a múltiples aviones físicos que usan este modelo

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModeloAvion extends Model
{
    // Tabla en base de datos
    protected $table = 'modelos_avion';

    // Campos masivos permitidos
    protected $fillable = [
        'nombre',
        'capacidad_total',
    ];

    // Relación: un modelo tiene muchos aviones
    public function aviones()
    {
        return $this->hasMany(Avion::class);
    }
}
