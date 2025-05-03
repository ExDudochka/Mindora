@extends('layouts.auth')

@section('title', 'Авторизация')

@section('content')
    <div class="wrapper">
        <div class="login-container">
            <h1 class="auth-header">Авторизация</h1>
            <form action="" method="post" id="auth-form">
                @csrf
                <label for="auth-login" class="label">Логин:</label>
                <input class="input" name="login" type="text" placeholder="Логин" id="auth-login" required />

                <label for="auth-password" class="label">Пароль:</label>
                <input class="pass" name="password" type="password" placeholder="Пароль" id="auth-password" required />

                <button class="submit" id="auth-submit">Войти</button>

                <div class="auth-links-container">
                    <p class="create_new"><a href="{{ route('register') }}" id="to-register">Нет аккаунта?</a></p>
                    <p class="forgot"><a href="#">Забыли пароль?</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
