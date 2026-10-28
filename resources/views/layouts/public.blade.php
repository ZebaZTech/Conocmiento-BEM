<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Focus Work</title>
    @vite(['resources/css/site.css'])
</head>
<body class="page">
    <x-header />
    <main>
        @yield('content')
    </main>
    <x-footer />
</body>
</html>
