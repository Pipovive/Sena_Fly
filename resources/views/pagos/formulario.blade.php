@extends('layouts.dashboard')

@section('title', 'Formulario de Pago')

@section('content')
    <div class="bg-white shadow p-6 rounded max-w-3xl mx-auto">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Formulario de Pago</h2>
            <a href="{{ url()->previous() }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                ← Volver
            </a>
        </div>

        <div class="mb-6 p-4 bg-gray-100 rounded">
            <h3 class="text-lg font-semibold mb-2">Detalles de la Reserva</h3>
            <p><strong>Código:</strong> {{ $reserva->codigo_reserva }}</p>
            <p><strong>Vuelo:</strong> {{ $reserva->vuelo->origen->nombre ?? 'N/A' }} →
                {{ $reserva->vuelo->destino->nombre ?? 'N/A' }}</p>
            <p><strong>Fecha:</strong> {{ $reserva->vuelo->fecha ?? 'N/A' }}</p>
            <p><strong>Hora:</strong> {{ $reserva->vuelo->hora_salida ?? '' }} - {{ $reserva->vuelo->hora_llegada ?? '' }}
            </p>
            <p><strong>Pasajeros:</strong> {{ $reserva->cantidad_pasajeros }}</p>
            <p><strong>Total a pagar:</strong> ${{ number_format($reserva->total_pagado, 0) }}</p>
            <p><strong>Estado:</strong> <span class="capitalize">{{ $reserva->estado }}</span></p>
        </div>

        @if ($reserva->estado == 'pendiente')
            <form action="{{ route('pagos.procesar', $reserva->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="metodo" class="block mb-1 font-medium">Método de Pago</label>
                    <select name="metodo" id="metodo" class="w-full border p-2 rounded">
                        <option value="tarjeta_credito">Tarjeta de Crédito</option>
                        <option value="debito">Débito</option>
                        <option value="pse">PSE</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="referencia" class="block mb-1 font-medium">Referencia de Pago</label>
                    <input type="text" name="referencia" id="referencia" class="w-full border p-2 rounded" required>
                </div>

                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Pagar ${{ number_format($reserva->total_pagado, 0) }}
                </button>
            </form>
        @else
            <p class="text-gray-600">Esta reserva ya ha sido pagada o está cancelada.</p>
        @endif

    </div>
@endsection
