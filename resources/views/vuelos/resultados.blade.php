@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow-lg p-6 rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Vuelos disponibles</h2>

    <!-- Vuelos de ida -->
    <h3 class="text-xl font-semibold mb-2">Vuelos de ida</h3>
    @forelse ($vuelosIda as $vuelo)
        <div class="border p-4 rounded mb-4">
            <p><strong>Código:</strong> {{ $vuelo->codigo_vuelo }}</p>
            <p><strong>Origen:</strong> {{ $vuelo->origen->ciudad }} → <strong>Destino:</strong> {{ $vuelo->destino->ciudad }}</p>
            <p><strong>Fecha salida:</strong> {{ $vuelo->fecha_salida }}</p>
            <p><strong>Precio:</strong> ${{ number_format($vuelo->precio, 2) }}</p>
            <a href="{{ url('/reserva/'.$vuelo->id) }}" class="bg-green-600 text-white px-4 py-2 rounded mt-2 inline-block">Seleccionar</a>
        </div>
    @empty
        <p>No hay vuelos de ida disponibles.</p>
    @endforelse

    <!-- Vuelos de regreso -->
    @if (isset($vuelosRegreso) && $vuelosRegreso->count() > 0)
        <h3 class="text-xl font-semibold mt-6 mb-2">Vuelos de regreso</h3>
        @foreach ($vuelosRegreso as $vuelo)
            <div class="border p-4 rounded mb-4">
                <p><strong>Código:</strong> {{ $vuelo->codigo_vuelo }}</p>
                <p><strong>Origen:</strong> {{ $vuelo->origen->ciudad }} → <strong>Destino:</strong> {{ $vuelo->destino->ciudad }}</p>
                <p><strong>Fecha salida:</strong> {{ $vuelo->fecha_salida }}</p>
                <p><strong>Precio:</strong> ${{ number_format($vuelo->precio, 2) }}</p>
            </div>
        @endforeach
    @endif
</div>
@endsection
