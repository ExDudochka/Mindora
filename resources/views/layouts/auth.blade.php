<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Мой сайт')</title>

    <!-- Подключаем стили и скрипты -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
</head>
<body>
<main class="auth-container">
    @yield('content')
</main>
</body>
</html>
