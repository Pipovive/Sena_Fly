<?php
// Modelo Avion: representa un avión y sus datos operativos
// Gestiona su relación con el modelo de avión, vuelos y asientos

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Clase para administrar aviones disponibles en la flota
class Avion extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'aviones';

    // Campos editables
    protected $fillable = [
        'modelo',
        'capacidad',
        'matricula',
        'modelo_avion_id'
    ];

    // Un avión puede tener muchos vuelos asociados
    public function vuelos()
    {
        return $this->hasMany(Vuelo::class);
    }

    // El modelo de avión al que pertenece (alias común)
    public function modeloAvion()
    {
        return $this->belongsTo(ModeloAvion::class);
    }
     
    // Alias alternativo para compatibilidad (mismo vínculo)
    public function modelo_avion()
    {
        return $this->belongsTo(ModeloAvion::class);
    }

    // Asientos configurados para este avión
    public function asientos()
    {
        return $this->hasMany(Asiento::class);
    }
}
