<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Pago;

class PagoController extends Controller
{
    public function formulario(Reserva $reserva)
    {
        
        return view('pagos.formulario', compact('reserva'));
    }

    public function procesarPago(Request $request, Reserva $reserva)
    {

        dd($request->all(), $reserva);
        $request->validate([
            'metodo' => 'required|in:tarjeta_credito,debito,pse',
            'numero_cuenta' => 'required|string',
            'fecha_vencimiento' => 'required|string',
            'cvv' => 'required|string',
            'nombre_titular' => 'required|string',
        ]);

        $pago = Pago::create([
            'reserva_id' => $reserva->id,
            'metodo' => $request->metodo,
            'estado' => 'exitoso', // por ahora simulamos pago exitoso
            'referencia' => 'REF' . rand(1000, 9999),
            'detalle' => json_encode($request->only('numero_cuenta', 'fecha_vencimiento', 'nombre_titular')),
        ]);

        $reserva->estado = 'pagada';
        $reserva->save();

        return redirect()->route('pagos.ver', $pago->id)
                         ->with('success', 'Pago realizado correctamente');
    }

    public function ver(Pago $pago)
    {
        return view('pagos.ver', compact('pago'));
    }
}
