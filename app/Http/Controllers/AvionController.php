<?php

namespace App\Http\Controllers;

use App\Models\Avion;
use App\Models\ModeloAvion;
use Illuminate\Http\Request;

class AvionController extends Controller
{
    public function index()
    {
        $aviones = Avion::all();
        $modelo_aviones = ModeloAvion::all();
        return view('admin.aviones.index', compact('aviones', 'modelo_aviones'));
    }

    public function create()
    {
   
        return view('admin.aviones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'capacidad_total' => 'required|integer|min:1',
        ]);

        ModeloAvion::create([
            'nombre' => $request->nombre,
            'capacidad_total' => $request->capacidad_total,
        ]);

        return redirect()->route('aviones.index')->with('success', 'Modelo de Avion creado exitosamente.');
    }

    public function asignar(Request $request)
    {
       $modelo_aviones = ModeloAvion::all();
       return view('admin.aviones.asignar', compact('modelo_aviones'));
    }

    public function asignarStore(Request $request)
    {
        $request->validate([
            'modelo_avion_id' => 'required|exists:modelos_avion,id',
            'matricula' => 'required|string|max:255|unique:aviones,matricula',
            'modelo_avion_id' => 'required|exists:modelos_avion,id',
            'nombre_operador' => 'required|string|max:255',

        ]);

        Avion::create([
            'modelo_avion_id' => $request->modelo_avion_id,
            'matricula' => $request->matricula,
            'nombre_operador' => $request->nombre_operador,
            'modelo_avion_id' => $request->modelo_avion_id,
        ]);

        return redirect()->route('aviones.index')->with('success', 'Avion asignado exitosamente.');
    }   
}
