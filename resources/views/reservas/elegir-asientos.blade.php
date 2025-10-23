@extends('layouts.dashboard')

@section('title', 'Seleccionar Asientos')

@section('content')
    <div class="bg-white p-6 rounded shadow">

        <h2 class="text-2xl font-bold mb-4">
            Selección de Asientos – Vuelo #{{ $vuelo->id }}
        </h2>

        <p class="mb-4 text-gray-700">
            Origen: <strong>{{ $vuelo->origen->nombre ?? 'N/A' }}</strong> |
            Destino: <strong>{{ $vuelo->destino->nombre ?? 'N/A' }}</strong> |
            Fecha: <strong>{{ $vuelo->fecha }}</strong>
        </p>


        <div class="grid grid-cols-6 gap-2 mb-6">
            @foreach ($asientos as $asiento)
                <div
                    class="text-center p-2 border rounded-lg font-semibold
                {{ $asiento->ocupado
                    ? 'bg-red-500 text-white cursor-not-allowed'
                    : 'bg-green-500 hover:bg-green-600 text-white cursor-pointer' }}">
                    {{ $asiento->codigo }}
                </div>
            @endforeach
        </div>

        <form action="{{ route('reservas.asientos.store', $reserva->id) }}" method="POST" class="mt-6">
            @csrf
            <h3 class="text-lg font-semibold mb-2">Selecciona tu asiento disponible:</h3>

            <select name="asiento_id" class="border p-2 rounded w-full mb-4" required>
                <option value="">-- Selecciona un asiento --</option>
                @foreach ($asientos as $asiento)
                    @if (!$asiento->ocupado)
                        <option value="{{ $asiento->id }}">{{ $asiento->codigo }}</option>
                    @endif
                @endforeach
            </select>

            <h3 class="text-lg font-semibold mb-2">Datos del pasajero</h3>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-semibold mb-1">Nombre:</label>
                    <input type="text" name="nombre" class="border p-2 rounded w-full" required>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Apellido:</label>
                    <input type="text" name="apellido" class="border p-2 rounded w-full" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-semibold mb-1">Tipo de documento:</label>
                    <select name="tipo_documento" class="border p-2 rounded w-full" required>
                        <option value="">-- Selecciona --</option>
                        <option value="CC">Cédula</option>
                        <option value="TI">Tarjeta de Identidad</option>
                        <option value="CE">Cédula de Extranjería</option>
                        <option value="Pasaporte">Pasaporte</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Número de documento:</label>
                    <input type="text" name="numero_documento" class="border p-2 rounded w-full" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-semibold mb-1">Correo electrónico:</label>
                    <input type="email" name="email" class="border p-2 rounded w-full">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Teléfono:</label>
                    <input type="text" name="telefono" class="border p-2 rounded w-full">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block font-semibold mb-1">Género:</label>
                    <select name="genero" class="border p-2 rounded w-full" required>
                        <option value="">-- Selecciona --</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                        <option value="O">Otro</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Fecha de nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" class="border p-2 rounded w-full" required>
                </div>
            </div>

            <div class="text-right">
                <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Guardar pasajero y asiento
                </button>
            </div>
        </form>
    </div>
@endsection
