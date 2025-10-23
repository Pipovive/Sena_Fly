@extends('layouts.dashboard')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Selecciona asiento para tu vuelo {{ $vuelo->id }}</h2>

    <div class="grid grid-cols-6 gap-2 mb-6">
        @foreach($asientos as $asiento)
            <div class="text-center p-2 border rounded 
                {{ $asiento->ocupado 
                    ? 'bg-red-500 text-white cursor-not-allowed' 
                    : 'bg-green-500 hover:bg-green-600 text-white cursor-pointer' }}">
                {{ $asiento->codigo }}
            </div>
        @endforeach
    </div>

    <form action="{{ route('reservas.asientos.store', $reserva->id) }}" method="POST">
        @csrf
        <label>Asiento disponible:</label>
        <select name="asiento_id" class="border p-2 rounded w-full mb-4">
            @foreach($asientos as $asiento)
                @if(!$asiento->ocupado)
                    <option value="{{ $asiento->id }}">{{ $asiento->codigo }}</option>
                @endif
            @endforeach
        </select>

        <h3 class="font-semibold mt-4 mb-2">Datos del pasajero</h3>
        <input name="nombre" placeholder="Nombre" class="border p-2 rounded w-full mb-2">
        <input name="apellido" placeholder="Apellido" class="border p-2 rounded w-full mb-2">
        <input name="tipo_documento" placeholder="Tipo de documento" class="border p-2 rounded w-full mb-2">
        <input name="numero_documento" placeholder="Número de documento" class="border p-2 rounded w-full mb-2">
        <input name="email" placeholder="Correo" class="border p-2 rounded w-full mb-2">
        <input name="telefono" placeholder="Teléfono" class="border p-2 rounded w-full mb-2">

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Guardar pasajero y asiento
        </button>
    </form>
</div>
@endsection
