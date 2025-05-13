<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ExamtestController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\PassTestController;

Route::get('/welcome', function () {
    return view('pages.welcome');
})->name('welcome');

// Домашняя страница

Route::get('/home', [CardController::class, 'index'])->name('home');

// Маршруты авторизации и регистрации

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::get('/register', [LoginController::class, 'showRegister'])->name('register');

Route::post('/login', [LoginController::class, 'authentication'])->name('authentication');
Route::post('/register', [LoginController::class, 'createRegister'])->name('createRegister');

// Маршруты создания теста

Route::middleware(['auth'])->group(function () {
    Route::get('/create-new-test', [ExamtestController::class, 'create'])->name('create-new-test');
    Route::post('/create-new-test/store', [ExamtestController::class, 'store'])->name('create-new-test.store');
});

// Маршруты прохождения теста

Route::middleware('auth')->group(function() {
    Route::get('/tests/pass/{id}', [PassTestController::class, 'show'])->name('tests.pass');
    Route::post('/tests/pass/{id}', [PassTestController::class, 'submit'])->name('tests.submit');

});
