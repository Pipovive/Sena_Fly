<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasajero extends Model
{
    use HasFactory;

    protected $table = 'pasajeros';

    protected $fillable = [
        'nombre',
        'apellido',
        'genero',
        'fecha_nacimiento',
        'tipo_documento',
        'numero_documento',
        'email',
        'telefono',
        'es_menor',
        'asiento'
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }
     protected static function boot()
    {
        parent::boot();

        static::creating(function ($pasajero) {
            $pasajero->es_menor = Carbon::parse($pasajero->fecha_nacimiento)->age < 18;
        });
    }
}
