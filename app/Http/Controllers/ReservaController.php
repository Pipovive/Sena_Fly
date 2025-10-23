<?php

namespace App\Http\Controllers;

use App\Models\Vuelo;
use App\Models\Reserva;
use App\Models\Pasajero;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Asiento;

class ReservaController extends Controller
{
    


    public function show($id)
{
    $reserva = Reserva::with('vuelo')->findOrFail($id);
    return view('reservas.show', compact('reserva'));
}

    // 1. Seleccionar vuelo
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
    public function seleccionarAsientos($reservaId)
{
    $reserva = Reserva::with('vuelo.avion.asientos')->findOrFail($reservaId);
    $vuelo = $reserva->vuelo;

    $asientosOcupados = Pasajero::whereHas('reserva', function ($q) use ($vuelo) {
        $q->where('vuelo_id', $vuelo->id);
    })->pluck('asiento_id')->toArray();

    $asientos = $vuelo->avion->asientos->map(function ($a) use ($asientosOcupados) {
        $a->ocupado = in_array($a->id, $asientosOcupados);
        return $a;
    });

    return view('reservas.elegir-asientos', compact('reserva', 'vuelo', 'asientos'));
}

public function guardarAsientoYpasajero(Request $request, $reservaId)
{
    $reserva = Reserva::findOrFail($reservaId);

    $request->validate([
        'asiento_id' => 'required|exists:asientos,id',
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'tipo_documento' => 'required|string',
        'numero_documento' => 'required|string',
        'genero' => 'required|string',
        'fecha_nacimiento' => 'required|date',
        'email' => 'nullable|email',
        'telefono' => 'nullable|string',
    ]);

    // ✅ Crear pasajero asociado a la reserva
    $esMenor = \Carbon\Carbon::parse($request->fecha_nacimiento)->age < 18;

    $pasajero = \App\Models\Pasajero::create([
        'reserva_id' => $reserva->id,
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'tipo_documento' => $request->tipo_documento,
        'numero_documento' => $request->numero_documento,
        'genero' => $request->genero,
        'fecha_nacimiento' => $request->fecha_nacimiento,
        'email' => $request->email,
        'telefono' => $request->telefono,
        'es_menor' => $esMenor,
        'asiento_id' => $request->asiento_id,
    ]);

    // ✅ Marcar el asiento como no disponible
    $asiento = \App\Models\Asiento::find($request->asiento_id);
    $asiento->disponible = false;
    $asiento->save();

    return redirect()
        ->route('reservas.detalle', $reserva->codigo_reserva)
        ->with('success', 'Pasajero y asiento registrados correctamente');
}



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
           $reserva = Reserva::with(['vuelo.origen', 'vuelo.destino', 'pasajeros.asiento'])
            ->where('codigo_reserva', $codigo)
            ->firstOrFail();

        return view('reservas.detalle', compact('reserva'));
    }

    public function create(Request $request)
{
    $vuelo = Vuelo::with(['origen', 'destino', 'avion'])->findOrFail($request->vuelo_id);

    // Asientos ocupados vienen de los pasajeros del vuelo
    $asientosOcupados = Pasajero::whereHas('reserva', function($query) use ($vuelo) {
        $query->where('vuelo_id', $vuelo->id);
    })->pluck('asiento')->toArray();

    return view('reservas.create', compact('vuelo', 'asientosOcupados'));
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

    public function formPasajeros($reserva_id)
{
      $reserva = Reserva::with('vuelo.avion.asientos')->findOrFail($reserva_id);

    // Filtrar solo los asientos NO ocupados
    $asientosOcupados = Pasajero::where('reserva_id', $reserva_id)->pluck('asiento')->toArray();

    $asientosDisponibles = $reserva->vuelo->avion->asientos
        ->whereNotIn('codigo', $asientosOcupados);

    return view('reservas.pasajeros', compact('reserva', 'asientosDisponibles'));
}

public function guardarPasajeros(Request $request, $id)
{
    $reserva = Reserva::findOrFail($id);

    $request->validate([
        'pasajeros.*.nombre' => 'required',
        'pasajeros.*.apellido' => 'required',
        'pasajeros.*.documento' => 'required',
        'pasajeros.*.asiento' => 'required',
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

    return redirect()->route('reservas.detalle', $reserva->codigo_reserva)
                     ->with('success', 'Pasajeros y asientos registrados correctamente');
}


}
