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
        $vuelos = Vuelo::with(['ciudadOrigen', 'ciudadDestino', 'avion'])->get();
        return view('vuelos.index', compact('vuelos'));
    }

    public function create()
    {
        $ciudades = Ciudad::all();
        $aviones = Avion::all();

        return view('vuelos.create', compact('ciudades', 'aviones'));
    }

    public function store(Request $request)
{
    // Validar los datos
    $request->validate([
        'codigo_vuelo' => 'required|unique:vuelos,codigo_vuelo',
        'ciudad_origen_id' => 'required|exists:ciudades,id',
        'ciudad_destino_id' => 'required|exists:ciudades,id|different:ciudad_origen_id',
        'fecha_salida' => 'required|date|after_or_equal:today',
        'fecha_llegada' => 'required|date|after:fecha_salida',
        'precio' => 'required|numeric|min:0',
        'estado' => 'required|in:programado,demorado,cancelado'
    ]);

    // Crear el vuelo
    Vuelo::create([
        'codigo_vuelo' => $request->codigo_vuelo,
        'ciudad_origen_id' => $request->ciudad_origen_id,
        'ciudad_destino_id' => $request->ciudad_destino_id,
        'fecha_salida' => $request->fecha_salida,
        'fecha_llegada' => $request->fecha_llegada,
        'precio' => $request->precio,
        'estado' => $request->estado,
    ]);

    // Redirigir con mensaje de éxito
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
            'codigo' => 'required|unique:vuelos,codigo,' . $vuelo->id,
            'ciudad_origen_id' => 'required|exists:ciudades,id',
            'ciudad_destino_id' => 'required|exists:ciudades,id',
            'avion_id' => 'required|exists:aviones,id',
            'fecha_salida' => 'required|date',
            'fecha_llegada' => 'required|date|after:fecha_salida',
            'precio' => 'required|numeric|min:0',
        ]);

        $vuelo->update($request->all());

        return redirect()->route('vuelos.index')->with('success', 'Vuelo actualizado correctamente.');
    }

    public function destroy(Vuelo $vuelo)
    {
        $vuelo->delete();
        return redirect()->route('vuelos.index')->with('success', 'Vuelo eliminado correctamente.');


    }

    
}




