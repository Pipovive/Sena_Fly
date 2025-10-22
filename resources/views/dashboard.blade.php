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
    <aside class="w-64 bg-blue-900 text-white h-screen fixed shadow-lg">
        <div class="p-6 text-center text-2xl font-bold border-b border-blue-700">
            ✈️ AirSystem
            {{ Auth::user()->name }}
        </div>
        <div class="p-6 border-b border-blue-700">
            <p class="text-sm">Usuario: {{ Auth::user()->email }}</p>
            <p class="text-sm">Rol: {{ Auth::user()->role }}</p>
        </div>
        <div class="p-6 border-b border-blue-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left hover:bg-blue-700 px-4 py-2 rounded">
                    🚪 Cerrar sesión
                </button>
            </form>

            <nav class="mt-6">
                <a href="{{ route('dashboard') }}" class="block px-6 py-3 hover:bg-blue-700">🏠 Dashboard</a>
                <a href="{{ route('vuelos.index') }}" class="block px-6 py-3 hover:bg-blue-700">🛫 Vuelos</a>
                <a href="{{ route('pasajeros.index') }}" class="block px-6 py-3 hover:bg-blue-700">🛫 Pasajeros</a>


                <a href="#" class="block px-6 py-3 hover:bg-blue-700">👤 Usuarios</a>

                <a href="#" class="block px-6 py-3 hover:bg-blue-700">⚙ Configuración</a>
                @if (Auth::user()->rol == 2)
                    <a href="{{ route('ciudades.index') }}" class="block px-6 py-3 hover:bg-blue-700">⚙ Ciudades</a>
                    <a href="{{ route('admin.reservas.index') }}" class="block px-6 py-3 hover:bg-blue-700">🎟
                        Reservas</a>
                    <a href="{{ route('aviones.index') }}" class="block px-6 py-3 hover:bg-blue-700">🎟
                        Aviones</a>
                @endif
            </nav>
    </aside>


    <main class="ml-64 w-full p-8">

        <div class="mb-6">
            <h1 class="text-3xl font-semibold">@yield('titulo', 'Dashboard')</h1>
            <p class="text-gray-500">@yield('subtitulo', 'Panel de administración')</p>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <form action="{{ route('vuelos.buscar') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700">Tipo de vuelo</label>
                        <select name="tipo_vuelo" id="tipo_vuelo" class="w-full border rounded-md p-2">
                            <option value="ida">Solo ida</option>
                            <option value="ida_vuelta">Ida y vuelta</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700">Número de pasajeros</label>
                        <select name="pasajeros" class="w-full border rounded-md p-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }}
                                    {{ $i == 1 ? 'pasajero' : 'pasajeros' }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700">Fecha de salida</label>
                        <input type="date" name="fecha_salida" id="fecha_salida" class="w-full border rounded-md p-2"
                            required>
                    </div>
                    <div id="fecha_regreso_container" class="hidden">
                        <label class="block text-gray-700">Fecha de regreso</label>
                        <input type="date" name="fecha_regreso" id="fecha_regreso"
                            class="w-full border rounded-md p-2">
                    </div>
                </div>
                <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Buscar vuelos
                </button>
            </form>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">ID</th>
                            <th class="py-2 px-4 border-b">Origen</th>
                            <th class="py-2 px-4 border-b">Destino</th>
                            <th class="py-2 px-4 border-b">Fecha de Salida</th>
                            <th class="py-2 px-4 border-b">Fecha de Regreso</th>
                            <th class="py-2 px-4 border-b">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vuelos as $vuelo)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $vuelo->id }}</td>
                                <td class="py-2 px-4 border-b">{{ $vuelo->origen }}</td>
                                <td class="py-2 px-4 border-b">{{ $vuelo->destino }}</td>
                                <td class="py-2 px-4 border-b">{{ $vuelo->fecha_salida }}</td>
                                <td class="py-2 px-4 border-b">{{ $vuelo->fecha_regreso }}</td>
                                <td class="py-2 px-4 border-b">
                                    <a href="#" class="text-blue-600 hover:underline">Ver</a>
                                </td>
                            </tr>
                        @endforeach
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
