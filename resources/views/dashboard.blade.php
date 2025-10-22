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

    <!-- Contenido principal -->
    <main class="ml-64 w-full p-8">
        <!-- Título de la sección -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold">@yield('titulo', 'Dashboard')</h1>
            <p class="text-gray-500">@yield('subtitulo', 'Panel de administración')</p>
        </div>

        <!-- Contenido dinámico -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            @yield('contenido')
        </div>
    </main>

</body>

</html>
