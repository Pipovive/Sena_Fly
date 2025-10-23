<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex">

    {{-- Sidebar reutilizable --}}
    @include('components.sidebar')

    {{-- Contenido principal con margen para el sidebar --}}
    <main class="ml-64 w-full p-8 h-screen overflow-y-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-semibold">@yield('title', 'Dashboard')</h1>
            <p class="text-gray-500">@yield('subtitle', 'Panel de administración')</p>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6">
            @yield('content')
        </div>
    </main>

</body>
</html>
