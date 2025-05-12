@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
    <div class="container">
        <h1>Доступные тесты</h1>

        <div class="tests-grid">
            @foreach ($examtests as $examtest)
                <div class="test-card">
                    <div class="test-card__header">
                        <h2 class="test-card__title">{{ $examtest->title }}</h2>
                    </div>

                    <div class="test-card__description">
                        {{ $examtest->description }}
                    </div>

                    <div class="test-card__meta">
                        @php
                            $count = $examtest->questions->count();
                            $word = match(true) {
                                $count === 1 => 'вопрос',
                                $count >= 2 && $count <= 4 => 'вопроса',
                                default => 'вопросов',
                            };
                        @endphp

                        <p>{{ $count }} {{ $word }}</p>
                    </div>

                    <div class="test-card__footer">
                        <button href="#" class="btn-base btn-accent">Пройти тест</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
