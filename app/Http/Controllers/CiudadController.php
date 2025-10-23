<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciudad;

class CiudadController extends Controller
{
    public function index()
    {   
        $ciudades = Ciudad::all()->where('estado', 1);
        return view('ciudades.index', compact('ciudades'));
    }
    public function create()
    {
        return view('ciudades.created');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo_iata' => 'required|string|max:10|unique:ciudades,codigo_iata',
            'pais' => 'required|string|max:255',
        ]);

        Ciudad::create($request->all());

        return redirect()->route('ciudades.index')->with('success', 'Ciudad creada exitosamente.');
    }

     public function softDelete($id)
    {
        $ciudad = Ciudad::findOrFail($id);
        $ciudad->estado = 0;
        $ciudad->save();

        return redirect()->route('ciudades.index')->with('success', 'Ciudad eliminada exitosamente.');
    }

}
