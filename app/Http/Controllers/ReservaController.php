<?php

namespace App\Http\Controllers;

use App\Models\Vuelo;
use App\Models\Reserva;
use App\Models\Pasajero;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReservaController extends Controller
{
    // 1. Buscar y seleccionar vuelo


    public function show($id)
{
    $reserva = Reserva::with('vuelo')->findOrFail($id);
    return view('reservas.show', compact('reserva'));
}


    public function seleccionarVuelo(Request $request)
    {
        $vuelos = [];

        if ($request->filled(['origen', 'destino', 'fecha'])) {
            $vuelos = Vuelo::where('origen_id', $request->origen)
                ->where('destino_id', $request->destino)
                ->where('fecha', $request->fecha)
                ->get();
        }

        return view('reservas.seleccionar-vuelo', compact('vuelos'));
    }

    // 2. Elegir asientos
    public function elegirAsientos(Request $request)
    {
        $vuelo = Vuelo::findOrFail($request->vuelo_id);
        $asientosOcupados = $vuelo->reservas()->pluck('asiento')->toArray();

        return view('reservas.elegir-asientos', compact('vuelo', 'asientosOcupados'));
    }

    // 3. Datos de pasajeros
    public function datosPasajeros(Request $request)
    {
        $vuelo = Vuelo::findOrFail($request->vuelo_id);
        $asientos = $request->asientos; // Array de asientos seleccionados

        return view('reservas.datos-pasajeros', compact('vuelo', 'asientos'));
    }

    // 4. Confirmar & guardar reserva
    public function confirmar(Request $request)
    {
        $codigo = strtoupper(Str::random(6)); // Código único de reserva

        $reserva = Reserva::create([
            'codigo' => $codigo,
            'vuelo_id' => $request->vuelo_id,
            'total' => $request->total,
            'estado_pago' => 'pendiente',
        ]);

        foreach ($request->pasajeros as $p) {
            Pasajero::create([
                'reserva_id' => $reserva->id,
                'nombre' => $p['nombre'],
                'apellido' => $p['apellido'],
                'documento' => $p['documento'],
                'asiento' => $p['asiento'],
            ]);
        }

        return redirect()->route('reservas.detalle', $codigo);
    }

    // 5. Ver detalle de reserva
    public function detalle($codigo)
    {
        $reserva = Reserva::where('codigo', $codigo)->firstOrFail();
        return view('reservas.detalle', compact('reserva'));
    }

    public function create(Request $request)
    {
        // Vuelo seleccionado (ej: /reservas/create?vuelo=5)
        $vuelo = Vuelo::findOrFail($request->vuelo);
        return view('reservas.create', compact('vuelo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vuelo_id' => 'required|exists:vuelos,id',
            'nombre_titular' => 'required',
            'apellido_titular' => 'required',
            'email_titular' => 'required|email',
            'cantidad_pasajeros' => 'required|integer|min:1|max:5',
        ]);

        $codigo = 'RSV-' . strtoupper(Str::random(6));

        $reserva = Reserva::create([
            'codigo_reserva' => $codigo,
            'vuelo_id' => $request->vuelo_id,
            'nombre_titular' => $request->nombre_titular,
            'apellido_titular' => $request->apellido_titular,
            'email_titular' => $request->email_titular,
            'cantidad_pasajeros' => $request->cantidad_pasajeros,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('reservas.show', $reserva->id)
                         ->with('success', 'Reserva creada correctamente');
    }

}
