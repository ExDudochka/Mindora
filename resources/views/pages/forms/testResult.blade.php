@extends('layouts.app')

@section('title', 'Результат теста')

@section('content')
    <div class="pass-test-container">
        <h1>Результаты теста: {{ $test->title }}</h1>

        @foreach ($test->questions as $question)
            <div class="question-block">
                <strong>{{ $question->text }}</strong>
                <div>
                    <p>Ваш ответ:
                        @php
                            $answer = $answers[$question->id] ?? null;
                        @endphp

                        @if (is_array($answer))
                            {{ implode(', ', $answer) }}
                        @else
                            {{ $answer }}
                        @endif
                    </p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
