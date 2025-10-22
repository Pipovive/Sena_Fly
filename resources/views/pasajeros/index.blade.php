@extends('layouts.dashboard')

@section('title', 'Vuelos')

@section('content')

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Listado de Pasajeros</h2>
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
                <th class="px-4 py-2">Apellido</th>
                <th class="px-4 py-2">Tipo de Documento</th>
                <th class="px-4 py-2">Numero Documento</th>
                <th class="px-4 py-2">Telefono</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pasajeros as $pasajero)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $pasajero->id }}</td>
                    <td class="px-4 py-2">{{ $pasajero->nombre }}</td>
                    <td class="px-4 py-2">{{ $pasajero->apellido }}</td>
                    <td class="px-4 py-2">{{ $pasajero->tipo_documento }}</td>
                    <td class="px-4 py-2">{{ $pasajero->numero_documento }}</td>
                    <td class="px-4 py-2">{{ $pasajero->telefono }}</td>
                    <td class="px-4 py-2">{{ $pasajero->email }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('pasajeros.edit', $pasajero) }}" class="text-blue-600">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
