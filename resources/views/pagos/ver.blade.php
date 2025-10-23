@extends('layouts.dashboard')

@section('title', 'Detalle de Pago')

@section('content')
    <div class="bg-white p-6 rounded shadow max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold mb-4">Pago Reserva: {{ $pago->reserva->codigo_reserva }}</h2>

        <p class="mb-2"><strong>Método:</strong> {{ ucfirst(str_replace('_', ' ', $pago->metodo)) }}</p>
        <p class="mb-2"><strong>Referencia:</strong> {{ $pago->referencia }}</p>
        <p class="mb-2"><strong>Estado:</strong> {{ ucfirst($pago->estado) }}</p>
        <p class="mb-2"><strong>Detalle:</strong></p>
        <pre class="bg-gray-100 p-2 rounded">{{ json_encode(json_decode($pago->detalle), JSON_PRETTY_PRINT) }}</pre>

        <div class="mt-4">
            <a href="{{ route('reservas.detalle', $pago->reserva->codigo_reserva) }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Volver a la reserva
            </a>
        </div>
    </div>
@endsection
