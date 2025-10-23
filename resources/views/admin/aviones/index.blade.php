@extends('layouts.dashboard')

@section('title', 'Aviones - Sistema de Vuelos')

@section('content')

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Listado de Aviones</h2>
        <a href="{{ route('aviones.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Crear Nuevo Modelo Avion
        </a>
        <a href="{{ route('aviones.asignar') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Registrar Avion
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
                <th class="border border-gray-300 px-4 py-2 text-center">Matrícula</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Modelo Avión</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Nombre Operador</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Capacidad Total</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aviones as $avion)
                <tr class="hover:bg-gray-50">   
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $avion->matricula }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $avion->modeloAvion->nombre ?? 'N/A' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $avion->nombre_operador }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $avion->modeloAvion->capacidad_total ?? 'N/A' }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('aviones.softDelete', $avion) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Inabilitar</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
