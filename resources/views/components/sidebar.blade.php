<!-- Sidebar reutilizable -->
<aside class="w-64 bg-blue-900 text-white h-screen fixed shadow-lg overflow-y-auto">
    <div class="p-6 text-center text-2xl font-bold border-b border-blue-700">
        ✈️ SenaFly
        {{ Auth::user()->name }}
    </div>
    <div class="p-6 border-b border-blue-700">
        <p class="text-sm">Usuario: {{ Auth::user()->email }}</p>
        <p class="text-sm">Rol: {{ Auth::user()->role }}</p>
    </div>
    <div class="p-6 border-b border-blue-700">
        <nav class="mt-6">
            <a href="{{ route('dashboard') }}" class="block px-6 py-3 hover:bg-blue-700">🏠 Dashboard</a>
            <a href="{{ route('vuelos.index') }}" class="block px-6 py-3 hover:bg-blue-700">🛫 Vuelos</a>
            <a href="{{ route('pasajeros.index') }}" class="block px-6 py-3 hover:bg-blue-700">🛫 Pasajeros</a>
            @if (Auth::user()->rol == 2)
                <a href="{{ route('ciudades.index') }}" class="block px-6 py-3 hover:bg-blue-700">⚙ Ciudades</a>
                <a href="{{ route('reservas.index') }}" class="block px-6 py-3 hover:bg-blue-700">🎟 Reservas</a>
                <a href="{{ route('aviones.index') }}" class="block px-6 py-3 hover:bg-blue-700">✈️ Aviones</a>
            @endif
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button type="submit" class="w-full text-left hover:bg-blue-700 px-4 py-2 rounded">
                🚪 Cerrar sesión
            </button>
        </form>
    </div>
</aside>
