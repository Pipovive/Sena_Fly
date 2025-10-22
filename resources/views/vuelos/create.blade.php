@extends('layouts.dashboard')

@section('title', 'Crear Vuelo')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Crear nuevo vuelo</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('vuelos.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold">Origen</label>
                    <select name="origen_id" class="w-full border p-2 rounded">
                        <option value="">Seleccione...</option>
                        @foreach ($ciudades as $ciudad)
                            <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold">Destino</label>
                    <select name="destino_id" class="w-full border p-2 rounded">
                        <option value="">Seleccione...</option>
                        @foreach ($ciudades as $ciudad)
                            <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold">Avión</label>
                    <select name="avion_id" class="w-full border p-2 rounded">
                        <option value="">Seleccione...</option>
                        @foreach ($aviones as $avion)
                            <option value="{{ $avion->id }}">{{ $avion->modelo }} (Capacidad:
                                {{ $avion->modelo_avion->capacidad_total }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold">Fecha</label>
                    <input type="date" name="fecha" class="w-full border p-2 rounded">
                </div>

                <div>
                    <label class="block font-semibold">Hora de salida</label>
                    <input type="time" name="hora_salida" class="w-full border p-2 rounded">
                </div>

                <div>
                    <label class="block font-semibold">Hora de llegada</label>
                    <input type="time" name="hora_llegada" class="w-full border p-2 rounded">
                </div>

                <div class="col-span-2">
                    <label class="block font-semibold">Precio</label>
                    <input type="number" name="precio" step="0.01" class="w-full border p-2 rounded">
                </div>
            </div>

            <div class="mt-4 flex justify-end">
                <a href="{{ route('vuelos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancelar</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Guardar</button>
            </div>
        </form>
    </div>
@endsection
