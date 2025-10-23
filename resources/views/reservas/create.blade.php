@extends('layouts.dashboard')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6">

    <h2 class="text-2xl font-bold mb-4 text-gray-800 text-center">
        Reserva de vuelo: {{ $vuelo->origen->nombre }} → {{ $vuelo->destino->nombre }}
    </h2>

    <p class="text-gray-600 text-center">
        Fecha: <strong>{{ $vuelo->fecha }}</strong> |
        Hora de salida: <strong>{{ $vuelo->hora_salida }}</strong> |
        Precio por persona: <strong>${{ number_format($vuelo->precio, 0, ',', '.') }}</strong>
    </p>

    {{-- FORMULARIO --}}
    <form action="{{ route('reservas.store') }}" method="POST" class="mt-6">
        @csrf

        {{-- ID del vuelo oculto --}}
        <input type="hidden" name="vuelo_id" value="{{ $vuelo->id }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label class="block text-gray-700">Nombre del titular</label>
                <input type="text" name="nombre_titular" value="{{ old('nombre_titular') }}"
                       class="w-full mt-1 border rounded px-3 py-2 @error('nombre_titular') border-red-500 @enderror" required>
                @error('nombre_titular')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700">Apellido del titular</label>
                <input type="text" name="apellido_titular" value="{{ old('apellido_titular') }}"
                       class="w-full mt-1 border rounded px-3 py-2 @error('apellido_titular') border-red-500 @enderror" required>
                @error('apellido_titular')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-gray-700">Correo electrónico</label>
                <input type="email" name="email_titular" value="{{ old('email_titular') }}"
                       class="w-full mt-1 border rounded px-3 py-2 @error('email_titular') border-red-500 @enderror" required>
                @error('email_titular')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-gray-700">Cantidad de pasajeros (máximo 5)</label>
                <input type="number" name="cantidad_pasajeros" min="1" max="5"
                       value="{{ old('cantidad_pasajeros', 1) }}"
                       class="w-full mt-1 border rounded px-3 py-2 @error('cantidad_pasajeros') border-red-500 @enderror" required>
                @error('cantidad_pasajeros')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

        </div>

        {{-- BOTÓN --}}
        <div class="text-center mt-6">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
                Confirmar reserva
            </button>
        </div>

    </form>
</div>
@endsection
