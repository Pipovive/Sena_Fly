<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Avion extends Model
{
    use HasFactory;

    protected $table = 'aviones';

    protected $fillable = [
        'modelo',
        'capacidad',
        'matricula',
        'modelo_avion_id'
    ];

    public function modeloAvion()
    {
        return $this->belongsTo(ModeloAvion::class);
    }

    public function vuelos()
    {
        return $this->hasMany(Vuelo::class);
    }
     
    public function modelo_avion()
    {
        return $this->belongsTo(ModeloAvion::class);
    }
}
