@extends('layouts.dashboard')

@section('title', 'Detalle de la Reserva')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">
        🧾 Detalle de Reserva: {{ $reserva->codigo_reserva }}
    </h2>

    {{-- 🔹 Información general --}}
    <div class="mb-6 border-b pb-4">
        <h3 class="text-lg font-semibold mb-2 text-gray-700">Información general</h3>
        <p><strong>Titular:</strong> {{ $reserva->nombre_titular }} {{ $reserva->apellido_titular }}</p>
        <p><strong>Correo:</strong> {{ $reserva->email_titular }}</p>
        <p><strong>Teléfono:</strong> {{ $reserva->telefono_titular ?? 'No registrado' }}</p>
        <p><strong>Estado:</strong> 
            <span class="px-2 py-1 rounded text-white 
                {{ $reserva->estado === 'pendiente' ? 'bg-yellow-500' : ($reserva->estado === 'pagada' ? 'bg-green-600' : 'bg-red-600') }}">
                {{ ucfirst($reserva->estado) }}
            </span>
        </p>
        <p><strong>Cantidad de pasajeros:</strong> {{ $reserva->cantidad_pasajeros }}</p>
        <p><strong>Total pagado:</strong> ${{ number_format($reserva->total_pagado ?? 0, 0, ',', '.') }}</p>
    </div>

    {{-- ✈️ Información del vuelo --}}
    @if($reserva->vuelo)
    <div class="mb-6 border-b pb-4">
        <h3 class="text-lg font-semibold mb-2 text-gray-700">Detalles del vuelo</h3>
        <p><strong>Vuelo ID:</strong> {{ $reserva->vuelo->id }}</p>
        <p><strong>Origen:</strong> {{ $reserva->vuelo->origen->nombre ?? 'N/A' }}</p>
        <p><strong>Destino:</strong> {{ $reserva->vuelo->destino->nombre ?? 'N/A' }}</p>
        <p><strong>Fecha:</strong> {{ $reserva->vuelo->fecha }}</p>
        <p><strong>Hora de salida:</strong> {{ $reserva->vuelo->hora_salida }}</p>
        <p><strong>Hora de llegada:</strong> {{ $reserva->vuelo->hora_llegada ?? 'N/A' }}</p>
        <p><strong>Precio base:</strong> ${{ number_format($reserva->vuelo->precio, 0, ',', '.') }}</p>
    </div>
    @endif

    {{-- 👥 Pasajeros --}}
    <div class="mb-6">
        <h3 class="text-lg font-semibold mb-3 text-gray-700">Pasajeros</h3>

        @if($reserva->pasajeros && $reserva->pasajeros->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-3 py-2 text-left">#</th>
                            <th class="border px-3 py-2 text-left">Nombre</th>
                            <th class="border px-3 py-2 text-left">Documento</th>
                            <th class="border px-3 py-2 text-left">Género</th>
                            <th class="border px-3 py-2 text-left">Asiento</th>
                            <th class="border px-3 py-2 text-left">Menor de edad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reserva->pasajeros as $index => $p)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-3 py-2">{{ $index + 1 }}</td>
                                <td class="border px-3 py-2">{{ $p->nombre }} {{ $p->apellido }}</td>
                                <td class="border px-3 py-2">{{ $p->tipo_documento }} {{ $p->numero_documento }}</td>
                                <td class="border px-3 py-2">{{ $p->genero }}</td>
                                <td class="border px-3 py-2">{{ $p->asiento->codigo ?? 'No asignado' }}</td>
                                <td class="border px-3 py-2">
                                    {{ $p->es_menor ? '✅ Sí' : '❌ No' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-600 italic">No hay pasajeros registrados para esta reserva.</p>
        @endif
    </div>

    {{-- 🔙 Botón de regreso --}}
    <div class="text-right">
        <a href="{{ route('reservas.index') }}" 
           class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
           ← Volver a mis reservas
        </a>
    </div>
</div>
@endsection
