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
        'matricula'
    ];

    public function vuelos()
    {
        return $this->hasMany(Vuelo::class);
    }
}
