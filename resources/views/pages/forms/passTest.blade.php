@extends('layouts.app')

@section('title', $test->title)

@section('content')
    <div class="pass-test-container">
        <div class="header">
            <h1>{{ $test->title }}</h1>
            <div class="date">Создан: {{ $test->created_at->format('d.m.Y') }}</div>
        </div>
        <p class="description">{{ $test->description }}</p>

        <form action="{{ route('tests.submit', $test->id) }}" method="post">
            @csrf

            @foreach ($test->questions as $index => $question)
                <div class="question-block">
                    <h3>{{ $index + 1 }}. {{ $question->content  }}</h3>

                    <p class="question-type">
                        @if ($question->type === 'single')
                            Выберите один вариант
                        @elseif ($question->type === 'multiple')
                            Выберите один или несколько вариантов
                        @endif
                    </p>

                    @if ($question->type === 'text')
                        <input type="text" name="answers[{{ $question->id }}]" class="test-input" placeholder="Введите ответ">
                    @elseif ($question->type === 'single')
                        <div class="options-container single">
                            @foreach ($question->options as $option)
                                <input type="radio" name="answers[{{ $question->id }}]" id="option-{{ $option->id }}" value="{{ $option->id }}" hidden>
                                <label for="option-{{ $option->id }}" class="option-section">
                                    {{ $option->content }}
                                </label>
                            @endforeach
                        </div>
                    @elseif ($question->type === 'multiple')
                        <div class="options-container multiple">
                            @foreach ($question->options as $option)
                                <input type="checkbox" name="answers[{{ $question->id }}][]" id="option-{{ $option->id }}" value="{{ $option->id }}" hidden>
                                <label for="option-{{ $option->id }}" class="option-section">
                                    {{ $option->content }}
                                </label>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach

            <div class="submit-container">
                <button type="submit" class="btn-accent btn-base">Отправить тест</button>
            </div>
        </form>
        <div class="pass-info">
            <div> <div class="author">Автор</div>{{ $test->author->login }}</div>
        </div>
    </div>
@endsection
