@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
    <div class="container">
        <div class="tests-grid">
            @foreach ($examtests as $examtest)
                <a class="test-card" href="{{ route('tests.pass', $examtest->id) }}">
                    <div class="test-card__category">
                        <b>{{ $examtest->category->name ?? 'Без категории'  }}</b>
                    </div>
                    <div class="test-card__header">
                        <h2 class="test-card__title">{{ $examtest->title }}</h2>
                    </div>

                    <div class="test-card__description">
                        {{ Str::limit($examtest->description, 133) }}
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
                        {{ $examtest->author->login }}
                        <button href="#" class="btn-base btn-accent">Пройти тест</button>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
