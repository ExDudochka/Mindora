<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Мой сайт')</title>

    <!-- Подключаем стили и скрипты -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/micromodal.js'])

    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
@include('components.header') <!-- Вставляем шапку -->

<main class="main-container">
    @yield('content') <!-- Здесь будет содержимое конкретной страницы -->
</main>

@include('components.footer') <!-- Вставляем подвал -->

<!-- Прочие компоненты -->

@include('components.auth-modal') <!-- Модальное окно авторизации -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
