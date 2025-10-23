@extends('layouts.dashboard')

@section('title', 'Pago de Reserva')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Pago de reserva #{{ $reserva->codigo_reserva }}</h2>

        <p class="mb-4">Vuelo: {{ $reserva->vuelo->origen->nombre ?? 'N/A' }} →
            {{ $reserva->vuelo->destino->nombre ?? 'N/A' }} | Fecha: {{ $reserva->vuelo->fecha }}
        </p>

        <p class="mb-4 font-semibold">
            Total a pagar: ${{ number_format($reserva->vuelo->precio * $reserva->cantidad_pasajeros, 0) }}
        </p>

        <form action="{{ route('reservas.pago.procesar', $reserva->codigo_reserva) }}" method="POST">
            @csrf

            <label class="block font-semibold mb-2">Método de pago</label>
            <select name="metodo" class="border p-2 rounded w-full mb-4" required>
                <option value="">-- Selecciona --</option>
                <option value="tarjeta_credito">Tarjeta de crédito</option>
                <option value="debito">Débito</option>
                <option value="pse">PSE</option>
            </select>

            {{-- Campos opcionales para tarjeta --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <input type="text" name="numero_tarjeta" placeholder="Número tarjeta" class="border p-2 rounded w-full">
                <input type="text" name="nombre_tarjeta" placeholder="Nombre en tarjeta"
                    class="border p-2 rounded w-full">
                <input type="text" name="fecha_vencimiento" placeholder="MM/YY" class="border p-2 rounded w-full">
                <input type="text" name="cvv" placeholder="CVV" class="border p-2 rounded w-full">
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Pagar
            </button>
        </form>
    </div>
@endsection
