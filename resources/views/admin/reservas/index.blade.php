@extends('layouts.dashboard')

@section('title', 'Reservas')

@section('content')

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Listado de Reservas</h2>
        <a href="{{ route('reservas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Insertar reservas
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
                <th class="px-4 py-2">Origen</th>
                <th class="px-4 py-2">Destino</th>
                <th class="px-4 py-2">Fecha</th>
                <th class="px-4 py-2">Precio</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservas as $reserva)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $reserva->origen->nombre }}</td>
                    <td class="px-4 py-2">{{ $reserva->destino->nombre }}</td>
                    <td class="px-4 py-2">{{ $reserva->fecha }}</td>
                    <td class="px-4 py-2">${{ $reserva->precio }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('reservas.edit', $reserva) }}" class="text-blue-600">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
