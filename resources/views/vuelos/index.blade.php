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

    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Avion</th>
                <th class="px-4 py-2">Operador</th>
                <th class="px-4 py-2">Origen</th>
                <th class="px-4 py-2">Destino</th>
                <th class="px-4 py-2">Fecha</th>
                <th class="px-4 py-2">Precio</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vuelos as $vuelo)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $vuelo->id }}</td>
                    <td class="px-4 py-2">{{ $vuelo->avion->modelo }} ({{ $vuelo->avion->matricula }})</td>
                    <td class="px-4 py-2">{{ optional($vuelo->origen)->nombre_operador ?? 'Avianca' }}</td>
                    <td class="px-4 py-2">{{ $vuelo->origen->nombre }}</td>
                    <td class="px-4 py-2">{{ $vuelo->destino->nombre }}</td>
                    <td class="px-4 py-2">{{ $vuelo->fecha }}</td>
                    <td class="px-4 py-2">${{ $vuelo->precio }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('vuelos.edit', $vuelo) }}" class="text-blue-600">Editar</a>
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('vuelos.edit', $vuelo) }}" class="text-blue-600">Editar</a>
                    </td>
                    <td class="px-4 py-2">
                        <form action="{{ route('vuelos.destroy', $vuelo) }}" method="POST"
                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este vuelo?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
