@extends('layouts.dashboard')

@section('title', 'Ciudades - Sistema de Vuelos')

@section('content')

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Listado de Aviones</h2>
        <a href="{{ route('aviones.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Crear Nuevo Modelo Avion
        </a>
        <a href="{{ route('aviones.asignar') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Asignacion de pilotos
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
                <th class="px-4 py-2">Matricula </th>
                <th class="px-4 py-2">Modelo Avion </th>
                <th class="px-4 py-2">Nombre Operador</th>
                <th class="px-4 py-2">Capacidad Total</th>
                <th class="px-4 py-2">Acciones</th>
                <th class="px-4 py-2">nombre_operador</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aviones as $avion)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $avion->id }}</td>
                    <td class="px-4 py-2">{{ $avion->matricula }}</td>
                    <td class="px-4 py-2">{{ $avion->modeloAvion->nombre ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $avion->nombre_operador }}</td>
                    <td class="px-4 py-2">{{ $avion->modeloAvion->capacidad_total ?? 'N/A' }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('aviones.softDelete', $avion) }}" class="text-blue-600">Inabilitar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
