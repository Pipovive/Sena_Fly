@extends('layouts.dashboard')

@section('title', 'Editar Vuelo')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Editar vuelo</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vuelos.update', $vuelo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="font-semibold">Origen</label>
                <select name="origen_id" class="w-full border p-2 rounded">
                    @foreach($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}" @if($ciudad->id == $vuelo->origen_id) selected @endif>
                            {{ $ciudad->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="font-semibold">Destino</label>
                <select name="destino_id" class="w-full border p-2 rounded">
                    @foreach($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}" @if($ciudad->id == $vuelo->destino_id) selected @endif>
                            {{ $ciudad->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="font-semibold">Avión</label>
                <select name="avion_id" class="w-full border p-2 rounded">
                    @foreach($aviones as $avion)
                        <option value="{{ $avion->id }}" @if($avion->id == $vuelo->avion_id) selected @endif>
                            {{ $avion->modelo }} (Capacidad: {{ $avion->capacidad }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="font-semibold">Fecha</label>
                <input type="date" name="fecha" value="{{ $vuelo->fecha }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-semibold">Hora salida</label>
                <input type="time" name="hora_salida" value="{{ $vuelo->hora_salida }}" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="font-semibold">Hora llegada</label>
                <input type="time" name="hora_llegada" value="{{ $vuelo->hora_llegada }}" class="w-full border p-2 rounded">
            </div>

            <div class="col-span-2">
                <label class="font-semibold">Precio</label>
                <input type="number" name="precio" value="{{ $vuelo->precio }}" class="w-full border p-2 rounded">
            </div>
        </div>

        <div class="mt-4 flex justify-end">
            <a href="{{ route('vuelos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Volver</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
        </div>
    </form>
</div>
@endsection
