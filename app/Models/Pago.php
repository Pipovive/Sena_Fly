<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'reserva_id',
        'metodo',
        'estado',
        'referencia',
        'detalle',
    ];

    // Si deseas que Laravel maneje automáticamente las fechas
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Relación con la reserva
     */
    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }
}
