<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BitKeys')</title>

    {{-- Cargar estilos y scripts desde Vite en localhost --}}
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="body">
    <header class="header">
        @include('partials.header')
    </header>

    <main class="main">
        @yield('content')
    </main>

    <footer class="footer">
        @include('partials.footer')
    </footer>
</body>
</html>