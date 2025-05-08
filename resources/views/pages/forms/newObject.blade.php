@extends('layouts.app')

@section('title', 'Создание теста')

@section('content')
    <div class="create-test-container">
        <h1>Создание теста</h1>
        <form class="new-test-form" action="{{ route('create_new_test.store') }}" method="post">
            @csrf

            <label class="test-label">Название теста:</label>
            <input class="test-input" name="title" type="text" required placeholder="Введите название теста"/>

            <label class="test-label">Описание:</label>
            <textarea class="test-input" name="description" rows="4" placeholder="Введите описание теста"></textarea>

            <label class="test-label">Категория:</label>
                <select class="test-input" name="category_id" required>
                    <option value="" disabled selected>Выберите категорию</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>

            <label class="test-label">Статус:</label>
            <select class="test-input" name="status" required>
                <option value="public">Публичный</option>
                <option value="restricted">Ограниченный</option>
                <option value="archived">Архив</option>
            </select>

            <h2>Вопросы к тесту</h2>

            <button class="test-submit">Перейти к созданию вопросов</button>

            <div class="links-container">
                <a href="">К списку тестов</a>
            </div>
        </form>
    </div>
@endsection
