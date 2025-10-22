@extends('layouts.dashboard')

@section('title', 'Crear Reserva')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Añadir Ciudad</h1>



        {{-- Formulario para crear la ciudad --}}
        <form action="{{ route('ciudades.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf



            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-medium">Nombre Ciudad:</label>
                    <input type="text" name="nombre" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block font-medium">Código IATA:</label>
                    <input type="text" name="codigo_iata" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label class="block font-medium">Pais:</label>
                    <select name="pais" class="w-full border rounded p-2" required>
                        <option value="Colombia">Colombia</option>
                        <option value="Estados Unidos">Estados Unidos</option>
                        <option value="México">México</option>
                        <option value="España">España</option>
                        <option value="Argentina">Argentina</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Crear
                </button>
            </div>
        </form>
    </div>
@endsection
