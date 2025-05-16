@extends('layouts.app')

@section('title', 'Результаты теста')

@section('content')
    <div class="test-result-container">
        @if ($pending)
            <div class="pending-message">
                {{ $message }}
            </div>
        @else
            <h1>Результаты теста</h1>
            <p>Вы набрали: <strong>{{ $score }} из {{ $maxScore }} баллов ({{ $percent }}%)</strong></p>
            <p>Оценка: <strong>{{ $grade }}</strong></p>
        @endif
    </div>
@endsection
