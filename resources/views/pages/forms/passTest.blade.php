@extends('layouts.app')

@section('title', $test->title)

@section('content')
    <div class="pass-test-container">
        <h1>{{ $test->title }}</h1>
        <p class="description">{{ $test->description }}</p>

        <form action="{{ route('tests.submit', $test->id) }}" method="post">
            @csrf

            @foreach ($test->questions as $index => $question)
                <div class="question-block">
                    <h3>{{ $index + 1 }}. {{ $question->content  }}</h3>

                    @if ($question->type === 'text')
                        <input type="text" name="answers[{{ $question->id }}]" class="test-input" placeholder="Введите ответ">
                    @elseif ($question->type === 'single')
                        @foreach ($question->options as $option)
                            <label class="option-label">
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}">
                                {{ $option->content }}
                            </label><br>
                        @endforeach
                    @elseif ($question->type === 'multiple')
                        @foreach ($question->options as $option)
                            <label class="option-label">
                                <input type="checkbox" name="answers[{{ $question->id }}][]" value="{{ $option->id }}">
                                {{ $option->content }}
                            </label><br>
                        @endforeach
                    @endif
                </div>
            @endforeach

            <button type="submit" class="btn-accent btn-base">Отправить тест</button>
        </form>
    </div>
@endsection
