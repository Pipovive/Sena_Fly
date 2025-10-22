<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow p-4">
        <h1 class="text-xl font-bold">Aerolínea - Panel de control</h1>
    </nav>

    <!-- Contenido principal -->
    <main class="container mx-auto mt-6">
        @yield('content')
    </main>

</body>
</html>
