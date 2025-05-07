@extends('layouts.auth')

@section('title', 'Авторизация')

@section('content')
    <div class="wrapper">
        <h1 class="auth-header">Авторизация</h1>
        <form class="login-form" action="{{ route("authentication") }}" method="post">
            @csrf
            <label for="auth-login" class="login-label">Логин:</label>
            <input class="login-input" name="login" type="text" placeholder="Логин"required />

            <label for="auth-password" class="login-label">Пароль:</label>
            <input class="pass" name="password" type="password" placeholder="Пароль"required />

            <button class="login-submit" id="auth-submit">Войти</button>

            <div class="auth-links-container">
                <p><a href="{{ route('register') }}">Нет аккаунта?</a></p>
                <p><a href="#">Забыли пароль?</a></p>
            </div>
        </form>
    </div>
@endsection
