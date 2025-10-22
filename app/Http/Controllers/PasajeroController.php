<?php

namespace App\Http\Controllers;

use App\Models\Pasajero;
use Illuminate\Http\Request;

class PasajeroController extends Controller
{
    public function index () {
        $pasajeros = Pasajero::all();
        return view('pasajeros.index', compact('pasajeros'));
    }
}
