@extends('layouts.dashboard')

@section('title', 'Resumen de Reserva')

@section('content')
<div class="container mx-auto py-6">

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold mb-4">✅ Reserva generada exitosamente</h1>

    {{-- Información de la reserva --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">📌 Datos de la reserva</h2>
        <p><strong>Código de reserva:</strong> {{ $reserva->codigo_reserva }}</p>
        <p><strong>Estado:</strong> {{ ucfirst($reserva->estado) }}</p>
        <p><strong>Cantidad de pasajeros:</strong> {{ $reserva->cantidad_pasajeros }}</p>
        <p><strong>Fecha de creación:</strong> {{ $reserva->created_at->format('d/m/Y H:i') }}</p>
    </div>

    {{-- Información del titular --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">👤 Titular de la reserva</h2>
        <p><strong>Nombre completo:</strong> {{ $reserva->nombre_titular }} {{ $reserva->apellido_titular }}</p>
        <p><strong>Email:</strong> {{ $reserva->email_titular }}</p>
        <p><strong>Teléfono:</strong> {{ $reserva->telefono_titular ?? 'No registrado' }}</p>
    </div>

    {{-- Información del vuelo --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">✈️ Información del vuelo</h2>
        <p><strong>Origen:</strong> {{ $reserva->vuelo->origen->nombre }}</p>
        <p><strong>Destino:</strong> {{ $reserva->vuelo->destino->nombre }}</p>
        <p><strong>Fecha de salida:</strong> {{ $reserva->vuelo->fecha }}</p>
        <p><strong>Hora de salida:</strong> {{ $reserva->vuelo->hora_salida }}</p>
        <p><strong>Precio por pasajero:</strong> ${{ number_format($reserva->vuelo->precio, 0, ',', '.') }}</p>
    </div>

    {{-- Botón para continuar --}}
    <div class="flex justify-end">
        <a href="{{ route('reservas.asientos', $reserva->id) }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Continuar: Registrar Pasajeros / Seleccionar Asientos
        </a>
    </div>

</div>
@endsection
