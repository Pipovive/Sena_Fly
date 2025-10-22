@extends('layouts.dashboard')

@section('titulo', 'Dashboard')
@section('subtitulo', 'Bienvenido al sistema de reservas aéreas')

@section('contenido')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-blue-600 text-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-bold">Vuelos</h2>
        <p class="text-2xl font-semibold mt-2">120</p>
    </div>

    <div class="bg-green-600 text-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-bold">Reservas</h2>
        <p class="text-2xl font-semibold mt-2">450</p>
    </div>

    <div class="bg-yellow-500 text-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-bold">Usuarios</h2>
        <p class="text-2xl font-semibold mt-2">89</p>
    </div>

</div>
@endsection
