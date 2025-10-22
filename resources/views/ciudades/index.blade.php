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

    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">codigo_iata</th>
                <th class="px-4 py-2">Pais</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ciudades as $ciudad)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $ciudad->id }}</td>
                    <td class="px-4 py-2">{{ $ciudad->nombre }}</td>
                    <td class="px-4 py-2">{{ $ciudad->codigo_iata }}</td>
                    <td class="px-4 py-2">{{ $ciudad->pais }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('ciudades.softDelete', $ciudad) }}" class="text-blue-600">Inabilitar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
