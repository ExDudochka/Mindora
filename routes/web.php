<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ExamtestController;

Route::get('/welcome', function () {
    return view('pages.welcome');
})->name('welcome');

Route::get('/home', function () {
    return view('pages.home');
})->name('home');

// Маршруты авторизации и регистрации

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::get('/register', [LoginController::class, 'showRegister'])->name('register');

Route::post('/login', [LoginController::class, 'authentication'])->name('authentication');
Route::post('/register', [LoginController::class, 'createRegister'])->name('createRegister');

// Маршруты создания теста

Route::middleware(['auth'])->group(function () {
    Route::get('/create_new_test', [ExamtestController::class, 'create'])->name('create_new_test');
    Route::post('/create_new_test/store', [ExamtestController::class, 'store'])->name('create_new_test.store');
});
