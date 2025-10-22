@extends('layouts.dashboard')

@section('title', 'Crear Vuelo')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Asigna Operador a tu avión!</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('aviones.asignarStore') }}" method="POST">
            @csrf

            <div>
                <label class="block font-semibold">Nombre</label>
                <input type="text" name="nombre" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block font-semibold">Matricula</label>
                <input type="text" name="matricula" class="w-full border p-2 rounded">
            </div>

            <label class="block font-semibold">Seleccionar Modelo</label>
            <select name="modelo_avion_id" class="w-full border p-2 rounded">
                <option value="">Seleccione un modelo</option>
                @foreach ($modelo_aviones as $modelo_avion)
                    <option value="{{ $modelo_avion->id }}">{{ $modelo_avion->nombre }}</option>
                @endforeach
            </select>

            <div>
                <label class="block font-semibold">Nombrar operador</label>
                <input type="text" name="nombre_operador" class="w-full border p-2 rounded">
            </div>

    </div>

    <div class="mt-4 flex justify-end">
        <a href="{{ route('aviones.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancelar</a>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Guardar</button>
    </div>
    </form>
    </div>
@endsection
