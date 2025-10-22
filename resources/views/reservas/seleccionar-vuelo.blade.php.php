@extends('layouts.dashboard')

@section('title', 'Buscar Vuelos')

@section('content')
<div class="bg-white shadow p-6 rounded">

    <h2 class="text-2xl font-bold mb-4">Buscar vuelos</h2>

    {{-- FORMULARIO DE BÚSQUEDA --}}
    <form method="GET" action="{{ route('reservas.seleccionarVuelo') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <div>
            <label class="block font-semibold mb-1">Origen</label>
            <select name="origen" class="w-full border rounded p-2" required>
                <option value="">Selecciona...</option>
                @foreach(App\Models\Ciudad::all() as $ciudad)
                    <option value="{{ $ciudad->id }}" {{ request('origen') == $ciudad->id ? 'selected' : '' }}>
                        {{ $ciudad->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Destino</label>
            <select name="destino" class="w-full border rounded p-2" required>
                <option value="">Selecciona...</option>
                @foreach(App\Models\Ciudad::all() as $ciudad)
                    <option value="{{ $ciudad->id }}" {{ request('destino') == $ciudad->id ? 'selected' : '' }}>
                        {{ $ciudad->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Fecha</label>
            <input type="date" name="fecha" value="{{ request('fecha') }}" class="w-full border rounded p-2" required>
        </div>

        <div class="flex items-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full hover:bg-blue-700">
                Buscar
            </button>
        </div>
    </form>

    {{-- RESULTADOS --}}
    @if(isset($vuelos) && count($vuelos) > 0)
        <h3 class="text-lg font-semibold mb-3">Vuelos disponibles</h3>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Origen</th>
                    <th class="border p-2">Destino</th>
                    <th class="border p-2">Fecha</th>
                    <th class="border p-2">Hora</th>
                    <th class="border p-2">Precio</th>
                    <th class="border p-2">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vuelos as $vuelo)
                    <tr>
                        <td class="border p-2">{{ $vuelo->origen->nombre }}</td>
                        <td class="border p-2">{{ $vuelo->destino->nombre }}</td>
                        <td class="border p-2">{{ $vuelo->fecha }}</td>
                        <td class="border p-2">{{ $vuelo->hora_salida }}</td>
                        <td class="border p-2">${{ number_format($vuelo->precio, 0) }}</td>
                        <td class="border p-2 text-center">
                            <form action="{{ route('reservas.elegirAsientos') }}" method="POST">
                                @csrf
                                <input type="hidden" name="vuelo_id" value="{{ $vuelo->id }}">
                                <button class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                    Seleccionar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @elseif(request()->filled(['origen', 'destino', 'fecha']))
        <p class="text-red-600 font-semibold">No hay vuelos disponibles para estos datos.</p>
    @endif

</div>
@endsection
