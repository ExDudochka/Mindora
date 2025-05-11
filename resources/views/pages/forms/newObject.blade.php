@extends('layouts.app')

@section('title', 'Создание теста')

@section('content')
    <div class="create-test-container">
        <div class="test-header">
            <h1>Создание теста</h1>
            <p class="test-description">Заполните основные данные и добавьте вопросы</p>
        </div>

        <form class="new-test-form" action="{{ route('create_new_test.store') }}" method="post">
            @csrf

            <div class="form-section">
                <div class="form-group">
                    <label class="test-label">Название теста:</label>
                    <input class="test-input" name="title" type="text" placeholder="Введите название теста" required/>
                </div>

                <div class="form-group">
                    <label class="test-label">Описание:</label>
                    <textarea class="test-input" name="description" rows="4" placeholder="Введите описание теста"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="test-label">Категория:</label>
                        <select class="test-input test-select" name="category_id" required>
                            <option value="" class="test-option" disabled selected>Выберите категорию</option>
                            @foreach ($categories as $category)
                                <option class="test-option" value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="test-label">Статус:</label>
                        <select class="test-input test-select" name="status" required>
                            <option class="test-option" value="public">Публичный</option>
                            <option class="test-option" value="restricted">Ограниченный</option>
                            <option class="test-option" value="archived">Архив</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="questions-section">
                <h2 class="section-title">Вопросы к тесту</h2>
                <div id="questions-wrap"></div>
            </div>

            <div class="form-actions">
                <button type="button" id="add-question" class="btn-secondary btn-base">Добавить вопрос</button>
                <button type="submit" class="btn-accent add-option">Создать тест</button>
            </div>
        </form>
    </div>

    {{-- Шаблон одного вопроса --}}
    <template id="tpl-question">
        <div class="question-card">
            <div class="question-header">
                <label class="test-label">Вопрос <span class="q-num"></span>:</label>
                <button type="button" class="btn-danger btn-base remove-question" title="Удалить этот вопрос">Удалить вопрос</button>
            </div>

            <input type="text" class="q-text test-input" placeholder="Текст вопроса" />

            <select class="q-type test-input test-select">
                <option value="single">Один из списка</option>
                <option value="multiple">Несколько из списка</option>
                <option value="text">Свободный ответ</option>
            </select>

            <div class="options-wrap"></div>

            <button type="button" class="btn-accent add-option btn-base">Добавить вариант</button>
        </div>
    </template>

    {{-- Шаблон одного варианта --}}
    <template id="tpl-option">
        <div class="option-item">
            <input type="text" class="opt-text test-input" placeholder="Вариант ответа" />

            <div class="option-controls">
                <label class="option-checkbox">
                    <input class="opt-correct" />
                    <span class="checkmark"></span>
                    <span class="option-label">Правильный</span>
                </label>
                <button type="button" class="remove-option btn-base" title="Удалить вариант ответа">
                    <span class="custom-cross"></span>
                </button>
            </div>
        </div>
    </template>
@endsection
