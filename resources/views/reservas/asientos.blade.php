@extends('layouts.dashboard')

@section('title', 'Seleccionar Asientos')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">
        Selecciona tus asientos para el vuelo {{ $reserva->vuelo->origen->nombre }} → {{ $reserva->vuelo->destino->nombre }}
    </h2>

    <p class="mb-4 text-gray-600">
        Capacidad del vuelo: {{ $reserva->vuelo->avion->modelo_avion->capacidad_total }} asientos<br>
        Pasajeros a registrar: {{ $reserva->cantidad_pasajeros }}
    </p>

    {{-- Mapa de asientos --}}
    <div class="grid grid-cols-6 gap-2 mb-6">
        @foreach($asientos as $asiento)
            <div class="text-center p-2 border rounded 
                {{ $asiento['ocupado'] 
                    ? 'bg-red-500 text-white cursor-not-allowed' 
                    : 'bg-green-500 hover:bg-green-600 text-white cursor-pointer' }}">
                {{ $asiento['codigo'] }}
            </div>
        @endforeach
    </div>

    {{-- Formulario de selección --}}
    <form action="{{ route('reservas.pasajeros.store', $reserva->id) }}" method="POST">
        @csrf
        <input type="hidden" name="vuelo_id" value="{{ $reserva->vuelo->id }}">

        <label class="block font-semibold mb-2">Selecciona los asientos (máx. {{ $reserva->cantidad_pasajeros }}):</label>
        <select name="asientos[]" class="border p-2 rounded w-full mb-4" multiple required size="6">
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
        </select>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Continuar con datos de pasajeros
        </button>
    </form>
</div>
@endsection
