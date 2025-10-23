@extends('layouts.dashboard')

@section('title', 'Vuelos')

@section('content')

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Listado de Vuelos</h2>
        <a href="{{ route('vuelos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Crear nuevo vuelo
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full table-auto w-full bg-white rounded shadow border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2 text-center">Avión</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Operador</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Origen</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Destino</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Fecha</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Precio</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vuelos as $vuelo)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $vuelo->avion->modelo }} ({{ $vuelo->avion->matricula }})</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ optional($vuelo->origen)->nombre_operador ?? 'Avianca' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $vuelo->origen->nombre }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $vuelo->destino->nombre }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $vuelo->fecha }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">${{ $vuelo->precio }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('vuelos.edit', $vuelo) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Editar</a>
                            <form action="{{ route('vuelos.destroy', $vuelo) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este vuelo?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
