<?php

namespace App\Http\Controllers;


use App\Models\Pasajero;
use Carbon\Carbon;
use Illuminate\Http\Request;
class PasajeroController extends Controller
{
    public function index () {
        $pasajeros = Pasajero::all();
        return view('pasajeros.index', compact('pasajeros'));
    }

public function store(Request $request)
{
    dd($request->all());
    $request->validate([
        'nombre'            => 'required|string|max:255',
        'apellido'          => 'required|string|max:255',
        'genero'            => 'required|string|max:1',
        'fecha_nacimiento'  => 'required|date',
        'tipo_documento'    => 'required|string',
        'numero_documento'  => 'required|string|unique:pasajeros,numero_documento',
        'email'             => 'required|email',
        'telefono'          => 'required|string',
        'asiento'           => 'required|string'
    ]);

    // Calcular si es menor de edad
    $esMenor = Carbon::parse($request->fecha_nacimiento)->age < 18 ? 1 : 0;

    Pasajero::create([
        'nombre'            => $request->nombre,
        'apellido'          => $request->apellido,
        'genero'            => $request->genero,
        'fecha_nacimiento'  => $request->fecha_nacimiento,
        'tipo_documento'    => $request->tipo_documento,
        'numero_documento'  => $request->numero_documento,
        'email'             => $request->email,
        'telefono'          => $request->telefono,
        'asiento'           => $request->asiento,
        'es_menor'          => $esMenor,
    ]);

    return redirect()->back()->with('success', 'Pasajero registrado con éxito.');
}

}       
