<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Vuelos</title>
    @vite('resources/css/app.css') <!-- Tailwind -->
</head>

<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    @include('components.sidebar')


    <main class="ml-64 w-full p-8 h-screen overflow-y-auto">

        <div class="mb-6">
            <h1 class="text-3xl font-semibold">@yield('titulo', 'Dashboard')</h1>
            <p class="text-gray-500">@yield('subtitulo', 'Panel de administración')</p>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <form action="{{ route('dashboard') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700">Origen</label>
                    <select name="origen_id" class="w-full border rounded p-2">
                        <option value="">-- Seleccione --</option>
                        @foreach ($ciudades as $ciudad)
                            <option value="{{ $ciudad->id }}"
                                {{ request('origen_id') == $ciudad->id ? 'selected' : '' }}>{{ $ciudad->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700">Destino</label>
                    <select name="destino_id" class="w-full border rounded p-2">
                        <option value="">-- Seleccione --</option>
                        @foreach ($ciudades as $ciudad)
                            <option value="{{ $ciudad->id }}"
                                {{ request('destino_id') == $ciudad->id ? 'selected' : '' }}>{{ $ciudad->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700">Tipo de vuelo</label>
                    <select name="tipo_vuelo" id="tipo_vuelo" class="w-full border rounded p-2">
                        <option value="ida" {{ request('tipo_vuelo') == 'ida' ? 'selected' : '' }}>Solo ida</option>
                        <option value="ida_vuelta" {{ request('tipo_vuelo') == 'ida_vuelta' ? 'selected' : '' }}>Ida y
                            vuelta</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700">Fecha de salida</label>
                    <input type="date" name="fecha_salida" value="{{ request('fecha_salida') }}"
                        class="w-full border rounded p-2">
                </div>

                <div id="fecha_regreso_container" class="{{ request('tipo_vuelo') == 'ida_vuelta' ? '' : 'hidden' }}">
                    <label class="block text-gray-700">Fecha de regreso</label>
                    <input type="date" name="fecha_regreso" value="{{ request('fecha_regreso') }}"
                        class="w-full border rounded p-2">
                </div>

                <div class="flex items-end">
                    <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Buscar vuelos
                    </button>
                </div>
            </form>

            <script>
                const tipoVuelo = document.getElementById('tipo_vuelo');
                const regreso = document.getElementById('fecha_regreso_container');

                tipoVuelo.addEventListener('change', function() {
                    if (this.value === 'ida_vuelta') {
                        regreso.classList.remove('hidden');
                    } else {
                        regreso.classList.add('hidden');
                        document.querySelector('input[name="fecha_regreso"]').value = '';
                    }
                });
            </script>



            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border">
                    <thead>
                        <tr>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Fecha</th>
                            <th>Hora Salida</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vuelos as $vuelo)
                            <tr>
                                <td>{{ $vuelo->origen->nombre }}</td>
                                <td>{{ $vuelo->destino->nombre }}</td>
                                <td>{{ $vuelo->fecha }}</td>
                                <td>{{ $vuelo->hora_salida }}</td>
                                <td><a href="#" class="text-blue-600 hover:underline">Ver</a></td>
                                <td class="px-4 py-2 text-center">
                                    <a href="{{ route('reservas.create', ['vuelo_id' => $vuelo->id]) }}"
                                        class="btn btn-primary">
                                        Reservar
                                    </a>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">
                                    No se encontraron vuelos con esos filtros.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const tipo = document.getElementById('tipo_vuelo');
                    const regresoContainer = document.getElementById('fecha_regreso_container');
                    const regresoInput = document.getElementById('fecha_regreso');

                    function toggleRegreso() {
                        if (tipo.value === 'ida_vuelta') {
                            regresoContainer.classList.remove('hidden');
                            regresoInput.required = true;
                        } else {
                            regresoContainer.classList.add('hidden');
                            regresoInput.required = false;
                            regresoInput.value = '';
                        }
                    }

                    tipo.addEventListener('change', toggleRegreso);
                    toggleRegreso(); // inicial
                });
            </script>
        </div>

        <script>
            document.querySelector('select[name="tipo_vuelo"]').addEventListener('change', function() {
                const fechaRegreso = document.querySelector('.fecha-regreso');
                if (this.value === 'ida_vuelta') {
                    fechaRegreso.classList.remove('hidden');
                } else {
                    fechaRegreso.classList.add('hidden');
                }
            });
        </script>


        <div class="bg-white shadow-lg rounded-lg p-6">
            @yield('contenido')
        </div>
    </main>

</body>

</html>
