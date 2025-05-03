@extends('layouts.auth')

@section('title', 'Регистрация')

@section('content')
    <div class="wrapper">
        <h1 class="auth-header">Регистрация</h1>
        <form method="post">
            @csrf

            <label class="label">Имя:</label>
            <input class="input" name="name" type="text" required placeholder="Ваше имя"/>

            <label class="label">Фамилия:</label>
            <input class="input" name="second_name" type="text" placeholder="Ваша фамилия (необязательно)"/>

            <label class="label">Отчество:</label>
            <input class="input" name="patronymic" type="text" placeholder="Ваше отчество (необязательно)"/>

            <label class="label">Логин:</label>
            <input class="input" name="login" type="text" required placeholder="Ваш логин"/>

            <label class="label">Email:</label>
            <input class="input" name="email" type="email" required placeholder="example@mail.ru"/>

            <label class="label">Телефон:</label>
            <input class="input" type="tel" name="phone" id="phone" placeholder="+7 (___) ___-__-__" required/>

            <label class="label">Пароль:</label>
            <input class="pass" type="password" name="password" required placeholder="Пароль"/>

            <label class="label">Повторите пароль:</label>
            <input class="pass" type="password" name="password_confirmation" required placeholder="Повторите пароль"/>

            <button class="submit">Зарегистрироваться</button>

            <div class="auth-links-container">
                <a href="{{ route('login') }}" id="to-login">Есть аккаунт?</a>
                <a href="#">Забыли пароль?</a>
            </div>
        </form>
    </div>
@endsection
