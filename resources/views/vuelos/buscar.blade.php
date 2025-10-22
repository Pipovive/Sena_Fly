@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg p-6 rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-center">Buscar vuelos</h2>
    
    <form action="{{ route('vuelos.buscar') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Origen --}}
            <div>
                <label class="block font-semibold">Origen</label>
                <select name="origen_id" class="w-full border px-3 py-2 rounded">
                    <option value="">Seleccione...</option>
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Destino --}}
            <div>
                <label class="block font-semibold">Destino</label>
                <select name="destino_id" class="w-full border px-3 py-2 rounded">
                    <option value="">Seleccione...</option>
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Fecha ida --}}
            <div>
                <label class="block font-semibold">Fecha de ida</label>
                <input type="date" name="fecha_ida" class="w-full border px-3 py-2 rounded">
            </div>
        </div>

        <div class="mt-6 text-center">
            <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Buscar vuelos
            </button>
        </div>
    </form>
</div>
@endsection
