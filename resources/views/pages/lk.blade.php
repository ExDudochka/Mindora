@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="lk-container">
        <aside class="lk-sidebar">
            <div class="lk-user-info">
                <!-- <img src="/images/user-avatar.png" alt="Аватар" class="lk-avatar"> -->
                <div class="lk-username">{{ $user->name }}</div>
            </div>
            <nav class="lk-nav">
                <a href="#" class="lk-nav-link active">Профиль</a>
                <a href="#" class="lk-nav-link">История активности</a>
                <a href="#" class="lk-nav-link">Мои тесты</a>
                <a href="#" class="lk-nav-link">Настройки</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="lk-nav-link logout">Выйти</button>
                </form>
            </nav>
        </aside>

        <main class="lk-main">
            <h1 class="lk-title">Личный кабинет</h1>

            {{-- Профиль --}}
            <div class="lk-profile-block" id="section-profile">
                <div class="lk-profile-item"><span class="label">Имя:</span> {{ $user->first_name }}</div>
                <div class="lk-profile-item"><span class="label">Email:</span> {{ $user->email }}</div>
            </div>

            {{-- Мои тесты --}}
            <div class="lk-profile-block" id="section-tests" style="display: none;">
                <h4>Мои тесты</h4>

                @if($userTests->isEmpty())
                    <p>У вас пока нет созданных тестов.</p>
                @else
                    <div class="lk-tests-grid">
                        @foreach($userTests as $test)
                            <div class="test-card" href="{{ route('tests.pass', $test->id) }}">
                                <div class="test-card__category">
                                    <b>{{ $test->category->name ?? 'Без категории'  }}</b>
                                </div>

                                <div class="test-card__header">
                                    <h2 class="test-card__title">{{ $test->title }}</h2>
                                </div>

                                <div class="test-card__description">
                                    {{ Str::limit($test->description, 133) }}
                                </div>

                                <div class="test-card__meta">
                                    @php
                                        $count = $test->questions->count();
                                        $word = match(true) {
                                            $count === 1 => 'вопрос',
                                            $count >= 2 && $count <= 4 => 'вопроса',
                                            default => 'вопросов',
                                        };
                                    @endphp
                                    <p>{{ $count }} {{ $word }}</p>
                                </div>

                                <div class="test-card__footer">
                                    <div class="author-lk">
                                        {{ $test->author->login }}
                                    </div>
                                    <div>
                                        <button class="btn-base btn-accent">Редактировать</button>
                                        <button
                                            class="btn-base btn-danger btn-delete-test"
                                            data-title="{{ $test->title }}"
                                            data-id="{{ $test->id }}">
                                            Удалить
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </main>

    </div>
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-window">
            <button class="modal-close">&times;</button>
            <h2>Удаление теста</h2>
            <p class="modal-warning"><strong>Внимание</strong></p>
            <ul>
                <li>Тест будет удалён <strong>НАВСЕГДА</strong>.</li>
                <li>Эта операция <strong>НЕ МОЖЕТ</strong> быть отменена.</li>
                <li>Это действие удалит все данные, связанные с этим тестом.</li>
            </ul>
            <p>Для подтверждения удаления введите название теста: <strong id="testTitlePlaceholder"></strong></p>
            <input type="text" id="confirmInput" placeholder="Введите название теста">
            <div class="modal-buttons">
                <button class="btn-cancel">Отменить</button>
                <button class="btn-confirm-delete" disabled>Удалить</button>
            </div>
        </div>
    </div>
@endsection
