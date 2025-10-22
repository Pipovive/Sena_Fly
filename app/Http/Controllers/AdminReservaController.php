<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;

class AdminReservaController extends Controller
{
    
    public function index()
    {
        $reservas = Reserva::all()->sortByDesc('created_at');
        return view('admin.reservas.index', compact('reservas'));
    }

    public function show($id)
    {
        $reserva = Reserva::findOrFail($id);
        return view('admin.reservas.show', compact('reserva'));
    }

    
    
}
