@extends('layouts.dashboard')

@section('title', 'Ciudades - Sistema de Vuelos')

@section('content')

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Listado de Ciudades</h2>
        <a href="{{ route('ciudades.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Crear nueva ciudad
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
                <th class="border border-gray-300 px-4 py-2 text-center">ID</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Nombre</th>
                <th class="border border-gray-300 px-4 py-2 text-center">código IATA</th>
                <th class="border border-gray-300 px-4 py-2 text-center">País</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ciudades as $ciudad)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $ciudad->id }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $ciudad->nombre }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $ciudad->codigo_iata }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $ciudad->pais }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('ciudades.softDelete', $ciudad) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Inabilitar</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
