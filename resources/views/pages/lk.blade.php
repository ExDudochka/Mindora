@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="lk-container">
        <aside class="lk-sidebar">
            <div class="lk-user-info">
                {{-- <img src="/images/user-avatar.png" alt="Аватар" class="lk-avatar"> --}}
                <div class="lk-username">{{ $user->name }}</div>
            </div>
            <nav class="lk-nav">
                <a href="#" class="lk-nav-link active" id="nav-profile">Профиль</a>
                <a href="#" class="lk-nav-link" id="nav-history">История активности</a>
                <a href="#" class="lk-nav-link" id="nav-tests">Мои тесты</a>
                <a href="#" class="lk-nav-link" id="nav-settings">Настройки</a>
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
                @if(!empty($user->middle_name))
                    <div class="lk-profile-item"><span class="label">Отчество:</span> {{ $user->middle_name }}</div>
                @endif
                <div class="lk-profile-item"><span class="label">Фамилия:</span> {{ $user->last_name }}</div>
                <div class="lk-profile-item"><span class="label">Логин:</span> {{ $user->login }}</div>
                <div class="lk-profile-item"><span class="label">Email:</span> {{ $user->email }}</div>
                <div class="lk-profile-item"><span class="label">Телефон:</span> {{ $user->phone }}</div>

                <button id="btnEditProfile" class="btn-base btn-accent">Изменить данные</button>
            </div>

            {{-- Мои тесты --}}
            <div class="lk-profile-block" id="section-tests" style="display: none;">
                <h4>Мои тесты</h4>

                @if($userTests->isEmpty())
                    <p>У вас пока нет созданных тестов.</p>
                @else
                    <div class="lk-tests-grid">
                        @foreach($userTests as $test)
                            <a class="test-card">
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
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </main>
    </div>

    {{-- Модалка удаления (оставим как есть) --}}
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

    {{-- Новая модалка редактирования профиля --}}
    <div class="modal-overlay" id="editProfileModal">
        <div class="modal-window">
            <button class="modal-close" id="editProfileCloseBtn">&times;</button>
            <h2>Редактирование профиля</h2>
            <form id="editProfileForm" method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <label for="first_name">Имя *</label>
                <input type="text" id="first_name" name="first_name" required value="{{ $user->first_name }}">

                <label for="middle_name">Отчество</label>
                <input type="text" id="middle_name" name="middle_name" value="{{ $user->middle_name }}">

                <label for="last_name">Фамилия *</label>
                <input type="text" id="last_name" name="last_name" required value="{{ $user->last_name }}">

                <label for="login">Логин *</label>
                <input type="text" id="login" name="login" required value="{{ $user->login }}">

                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required value="{{ $user->email }}">

                <label for="phone">Телефон *</label>
                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone', $user->phone) }}"
                    placeholder="Введите номер телефона"
                />

                <div class="modal-buttons" style="margin-top: 20px;">
                    <button type="button" class="btn-cancel" id="cancelEditProfile">Отменить</button>
                    <button type="submit" class="btn-base btn-accent">Сохранить</button>
                </div>
            </form>
        </div>
    </div>

    {{-- JS для открытия/закрытия модалки --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btnEditProfile = document.getElementById('btnEditProfile');
            const editProfileModal = document.getElementById('editProfileModal');
            const editProfileCloseBtn = document.getElementById('editProfileCloseBtn');
            const cancelEditProfileBtn = document.getElementById('cancelEditProfile');

            function closeModal() {
                editProfileModal.classList.remove('active');
            }

            btnEditProfile.addEventListener('click', () => {
                editProfileModal.classList.add('active');
            });

            editProfileCloseBtn.addEventListener('click', closeModal);
            cancelEditProfileBtn.addEventListener('click', closeModal);

            // Закрытие по клику вне окна
            editProfileModal.addEventListener('click', (e) => {
                if (e.target === editProfileModal) {
                    closeModal();
                }
            });

            // Можно добавить AJAX отправку, но здесь простой submit формы
        });
    </script>

@endsection
