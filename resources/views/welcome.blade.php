@extends('layouts.app')

@section('title', 'Mindora — прогрессивная образовательная платформа')

@section('content')
    <section class="features">
        <div class="features-container">
{{--            <h1 class="pt-4 slogan">Mindora — современный подход к получению теоретических знаний</h1>--}}
            <div class="row mt-5 mb-4">
                <div class="col-md-6 feature-text">
                    <h2 class="fw-bold mb-3">Ваш цифровой помощник в обучении и преподавании</h2>
                    <p>Наш сервис объединяет студентов, преподавателей и всех, кто хочет учиться с
                        удовольствием. Здесь вы найдете инструменты для создания тестов, подготовки
                        к экзаменам и обмена знаниями. Простой интерфейс, гибкие настройки и безопасность.
                        Обучение стало эффективным, а преподавание — комфортным.</p>
                </div>
                <div class="col-md-6 feature-image image-container">
                    <img id="helper-light" src="{{ asset('images/light/devices.png') }}" alt="Helper" draggable="false">
                </div>
            </div>

            <div class="row mt-5 mb-4">
                <div class="col-md-6 feature-image image-container">
                    <img id="growth-light" src="{{ asset('images/light/growth.png') }}" alt="Security" draggable="false">
                </div>
                <div class="col-md-6 feature-text">
                    <h2 class="fw-bold mb-3">Обратная связь, которая помогает развиваться</h2>
                    <p>После завершения теста система анализирует ваши ответы: выделяет
                        проблемные темы, сравнивает с прошлыми результатами и предлагает
                        материалы для улучшения. Детальный разбор помогает самостоятельно
                        выявить слабые стороны и целенаправленно работать над их устранением.</p>
                </div>
            </div>

{{--            <div class="row">--}}
{{--                <div class="col-md-6 feature-text">--}}
{{--                    <h2>Обратная связь, которая помогает развиваться</h2>--}}
{{--                    <p>После завершения теста система анализирует ваши ответы, выделяет проблемные темы...</p>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 feature-image">--}}
{{--                    <img src="images/feedback.png" alt="Feedback">--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="row">--}}
{{--                <div class="col-md-6 feature-image">--}}
{{--                    <img src="{{ asset('images/light/storage.png' )}}" alt="Library">--}}
{{--                </div>--}}
{{--                <div class="col-md-6 feature-text">--}}
{{--                    <h2>Персонализированная библиотека материалов</h2>--}}
{{--                    <p>Собирайте персональную библиотеку: сохраняйте тесты в избранное, группируйте их по темам...</p>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>

{{--    <section class="call-to-action">--}}
{{--        <div class="container text-center">--}}
{{--            <h2>Начните прямо сейчас</h2>--}}
{{--            <p>Наша платформа предлагает уникальные инструменты для обучения...</p>--}}
{{--            <button class="btn btn-primary">Зарегистрироваться</button>--}}
{{--            <button class="btn btn-secondary">Авторизоваться</button>--}}
{{--        </div>--}}
{{--    </section>--}}
@endsection
