<?php
// Este archivo maneja la parte administrativa de las reservas de vuelos
// Permite a los administradores ver y gestionar todas las reservas del sistema
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;

// Controlador para que los administradores gestionen las reservas
class AdminReservaController extends Controller
{
    // Muestra todas las reservas ordenadas por las más recientes primero
    // Se usa en el panel de administración principal de reservas
    public function index()
    {
        $reservas = Reserva::all()->sortByDesc('created_at');
        return view('admin.reservas.index', compact('reservas'));
    }

    // Muestra el detalle completo de una reserva específica
    public function show($id)
    {
        $reserva = Reserva::findOrFail($id);
        return view('admin.reservas.show', compact('reserva'));
    }
}
