<?php

namespace App\Http\Controllers;

use App\Models\Vuelo;
use App\Models\Ciudad;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VueloPublicController extends Controller
{
    // Página inicial con formulario de búsqueda
    public function index()
    {
        $ciudades = Ciudad::all();
        return view('public.vuelos.buscar', compact('ciudades'));
    }

    // Procesar búsqueda
    public function buscar(Request $request)
    {
        $request->validate([
            'origen_id' => 'required|exists:ciudades,id',
            'destino_id' => 'required|exists:ciudades,id|different:origen_id',
            'fecha_ida' => 'required|date|after_or_equal:today|before_or_equal:' . Carbon::now()->addMonths(2)->format('Y-m-d'),
        ], [
            'destino_id.different' => 'El destino debe ser diferente al origen.',
        ]);

        $vuelos = Vuelo::where('origen_id', $request->origen_id)
            ->where('destino_id', $request->destino_id)
            ->whereDate('fecha', $request->fecha_ida)
            ->with('avion')
            ->get();

        return view('public.vuelos.resultados', compact('vuelos'));
    }
}
