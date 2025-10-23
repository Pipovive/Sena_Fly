<?php

namespace App\Http\Controllers;

use App\Models\Vuelo;
use App\Models\Ciudad;
use App\Models\Avion;
use Illuminate\Http\Request;

class VueloController extends Controller
{
    public function index()
    {
        $vuelos = Vuelo::with(['origen', 'destino', 'avion'])->get();
        return view('vuelos.index', compact('vuelos'));
    }

    public function dashboard(Request $request)
{
    $ciudades = Ciudad::all();

    $query = Vuelo::with(['origen', 'destino', 'avion'])
        ->where('estado', 'programado');

    if ($request->filled('origen_id')) {
        $query->where('origen_id', $request->origen_id);
    }

    if ($request->filled('destino_id')) {
        $query->where('destino_id', $request->destino_id);
    }

    if ($request->filled('fecha_salida')) {
        $query->whereDate('fecha', $request->fecha_salida);
    }

    // Si selecciona ida y vuelta, mostrar vuelos de ida y de regreso disponibles
    if ($request->tipo_vuelo === 'ida_vuelta' && $request->filled('fecha_regreso')) {
        $query->orWhere(function ($q) use ($request) {
            $q->where('origen_id', $request->destino_id)
              ->where('destino_id', $request->origen_id)
              ->whereDate('fecha', $request->fecha_regreso);
        });
    }

    $vuelos = $query->get();

    return view('dashboard', compact('vuelos', 'ciudades'));
}


    public function create()
    {
        $ciudades = Ciudad::all();
        $aviones = Avion::all();

        return view('vuelos.create', compact('ciudades', 'aviones'));
    }

    public function store(Request $request)
{

    $request->validate([
        'origen_id' => 'required|exists:ciudades,id',
        'destino_id' => 'required|exists:ciudades,id|different:origen_id',
        'avion_id'=> 'required|exists:aviones,id',
        'fecha' => 'required|date|after_or_equal:today',
        'hora_salida' => 'required',
        'hora_llegada' => 'required',
        'precio' => 'required|numeric|min:0',
        'estado' => 'required|in:programado,demorado,cancelado'
    ]);


    Vuelo::create([
        'origen_id' => $request->origen_id,
        'destino_id' => $request->destino_id,
        'avion_id' => $request->avion_id,
        'fecha' => $request->fecha,
        'hora_salida' => $request->hora_salida,
        'hora_llegada' => $request->hora_llegada,
        'precio' => $request->precio,
        'estado' => $request->estado,
    ]);

   
    return redirect()->route('vuelos.index')->with('success', 'Vuelo creado correctamente');
}


    public function show(Vuelo $vuelo)
    {
        return view('vuelos.show', compact('vuelo'));
    }

    public function edit(Vuelo $vuelo)
    {
        $ciudades = Ciudad::all();
        $aviones = Avion::all();
        return view('vuelos.edit', compact('vuelo', 'ciudades', 'aviones'));
    }

    public function update(Request $request, Vuelo $vuelo)
    {
        $request->validate([
            'origen_id' => 'required|exists:ciudades,id',
            'destino_id' => 'required|exists:ciudades,id|different:origen_id',
            'avion_id'=> 'required|exists:aviones,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora_salida' => 'required',
            'hora_llegada' => 'required',
            'precio' => 'required|numeric|min:0',
            'estado' => 'required|in:programado,demorado,cancelado'
        ]);

        $vuelo->update($request->all());

        return redirect()->route('vuelos.index')->with('success', 'Vuelo actualizado correctamente.');
    }

    public function destroy(Vuelo $vuelo)
    {
        $vuelo->delete();
        return redirect()->route('vuelos.index')->with('success', 'Vuelo eliminado correctamente.');


    }
    public function buscar(Request $request)
    {
        $request->validate([
            'origen_id' => 'required|exists:ciudades,id',
            'destino_id' => 'required|exists:ciudades,id|different:origen_id',
            'fecha' => 'required|date|after_or_equal:today',
        ]);

        $vuelos = Vuelo::where('origen_id', $request->origen_id)
            ->where('destino_id', $request->destino_id)
            ->where('fecha', $request->fecha)
            ->where('estado', 'programado')
            ->with(['origen', 'destino', 'avion'])
            ->get();

        return view('vuelos.index', compact('vuelos'));
    }

    public function buscarVuelos(Request $request)
    {
        $vuelos = Vuelo::where('origen_id', $request->origen)
            ->where('destino_id', $request->destino)
            ->whereDate('fecha_salida', $request->fecha_ida)
            ->when($request->tipo_vuelo === 'ida_y_vuelta', function ($query) use ($request) {
                $query->whereDate('fecha_regreso', $request->fecha_vuelta);
            })
            ->get();

        return view('vuelos.resultados', compact('vuelos'));
    }
        
}




