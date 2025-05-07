@extends('layouts.auth')

@section('title', 'Регистрация')

@section('content')
    <div class="wrapper">
        <h1 class="auth-header">Регистрация</h1>
        <form class="register-form" action="{{ route("register") }}" method="post">
            @csrf
            <label class="register-label">Имя:</label>
            <input class="register-input" name="first_name" type="text" required placeholder="Ваше имя"/>

            <label class="register-label">Фамилия:</label>
            <input class="register-input" name="last_name" type="text" placeholder="Ваша фамилия (необязательно)"/>

            <label class="register-label">Отчество:</label>
            <input class="register-input" name="middle_name" type="text" placeholder="Ваше отчество (необязательно)"/>

            <label class="register-label">Логин:</label>
            <input class="register-input" name="login" type="text" required placeholder="Ваш логин"/>

            <label class="register-label">Email:</label>
            <input class="register-input" name="email" type="email" required placeholder="example@mail.ru"/>

            <label class="register-label">Телефон:</label>
            <input class="register-input" type="tel" name="phone" id="phone" placeholder="+7 (___) ___-__-__" required/>

            <label class="register-label">Пароль:</label>
            <input class="pass" type="password" name="password" required placeholder="Пароль"/>

            <label class="register-label">Повторите пароль:</label>
            <input class="pass" type="password" name="password_confirmation" required placeholder="Повторите пароль"/>
            <span class="toggle-password" id="toggle-password"></span>

            <button class="register-submit">Зарегистрироваться</button>

            <div class="auth-links-container">
                <a href="{{ route('login') }}">Есть аккаунт?</a>
            </div>
        </form>
    </div>
@endsection
