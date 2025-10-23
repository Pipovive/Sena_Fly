@extends('layouts.dashboard')

@section('title', 'Mis Reservas')

@section('content')
    <div class="bg-white shadow p-6 rounded">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Mis Reservas</h2>
            <a href="{{ url()->previous() }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                ← Volver
            </a>
        </div>

        @if ($reservas->count() > 0)
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2 text-left">Código</th>
                        <th class="border p-2 text-left">Vuelo</th>
                        <th class="border p-2 text-left">Fecha</th>
                        <th class="border p-2 text-left">Pasajeros</th>
                        <th class="border p-2 text-left">Total pagado</th>
                        <th class="border p-2 text-left">Estado</th>
                        <th class="border p-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservas as $reserva)
                        <tr>
                            <td class="border p-2">{{ $reserva->codigo_reserva }}</td>
                            <td class="border p-2">
                                {{ $reserva->vuelo->origen->nombre ?? 'N/A' }} →
                                {{ $reserva->vuelo->destino->nombre ?? 'N/A' }}
                                <br>
                                {{ $reserva->vuelo->hora_salida ?? '' }} - {{ $reserva->vuelo->hora_llegada ?? '' }}
                            </td>
                            <td class="border p-2">{{ $reserva->vuelo->fecha ?? 'N/A' }}</td>
                            <td class="border p-2">
                                {{ $reserva->cantidad_pasajeros }}<br>
                                @foreach ($reserva->pasajeros as $pasajero)
                                    <span class="text-sm text-gray-600">
                                        {{ $pasajero->nombre }} {{ $pasajero->apellido }}
                                        ({{ $pasajero->asiento->codigo ?? 'Sin asiento' }})
                                    </span><br>
                                @endforeach
                            </td>
                            <td class="border p-2">
                                ${{ number_format($reserva->total_pagado ?? 0, 0) }}
                            </td>
                            <td class="border p-2 capitalize">{{ $reserva->estado }}</td>
                            <td class="border p-2 text-center">
                                <a href="{{ route('reservas.detalle', $reserva->codigo_reserva) }}"
                                    class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                    Ver detalle
                                </a>

                                @if ($reserva->estado == 'pendiente')
                                    <a href="{{ route('pagos.formulario', $reserva) }}"
                                        class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                        Ir a pagar
                                    </a>
                                @else
                                    <a href="{{ route('pagos.ver', $reserva->id) }}"
                                        class="bg-gray-600 text-white px-3 py-1 rounded cursor-not-allowed">
                                        Ver pago
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600">No tienes reservas registradas.</p>
        @endif

    </div>
@endsection
