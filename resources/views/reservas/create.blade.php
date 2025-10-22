@extends('layouts.dashboard')

@section('title', 'Crear Reserva')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Reserva de vuelo</h1>

        {{-- Información del vuelo seleccionado --}}
        <div class="bg-white shadow-md rounded-lg p-4 mb-6">
            <h2 class="text-lg font-semibold mb-2">Información del vuelo</h2>
            <p><strong>Origen:</strong> {{ $vuelo->origen }}</p>
            <p><strong>Destino:</strong> {{ $vuelo->destino }}</p>
            <p><strong>Fecha:</strong> {{ $vuelo->fecha_salida }}</p>
            <p><strong>Hora:</strong> {{ $vuelo->hora_salida }}</p>
            <p><strong>Precio por pasajero:</strong> ${{ number_format($vuelo->precio, 0, ',', '.') }}</p>
        </div>

        {{-- Formulario para crear la reserva --}}
        <form action="{{ route('reservas.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf

            <input type="hidden" name="vuelo_id" value="{{ $vuelo->id }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-medium">Nombre del titular:</label>
                    <input type="text" name="nombre_titular" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block font-medium">Apellido del titular:</label>
                    <input type="text" name="apellido_titular" class="w-full border rounded p-2" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-medium">Correo electrónico:</label>
                    <input type="email" name="email_titular" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block font-medium">Teléfono:</label>
                    <input type="text" name="telefono_titular" class="w-full border rounded p-2">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Cantidad de pasajeros (máximo 5):</label>
                <input type="number" name="cantidad_pasajeros" min="1" max="5"
                    class="w-full border rounded p-2" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Continuar con la reserva
                </button>
            </div>
        </form>
    </div>
@endsection
