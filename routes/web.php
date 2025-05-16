<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//Controllers
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ExamtestController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\PassTestController;
use App\Http\Controllers\LkController;

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

    // Страница редактирования
    Route::get('/tests/{test}/edit',   [ExamtestController::class, 'edit'])->name('tests.edit');
    Route::patch('/tests/{test}',      [ExamtestController::class, 'update'])->name('tests.update');
});

// Маршруты прохождения теста

Route::middleware('auth')->group(function() {
    Route::get('/tests/pass/{id}', [PassTestController::class, 'index'])->name('tests.pass');
    Route::post('/tests/pass/{id}', [PassTestController::class, 'submit'])->name('tests.submit');
});

// Личный кабинет

Route::middleware('auth')->get('/lk', [LkController::class, 'index'])->name('lk');

// logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/welcome');
})->name('logout');


Route::get('/tests/delete/{id}', function ($id) {
    DB::table('examtests')->where('id', $id)->delete();
    return redirect()->back()->with('success', 'Тест удалён');
})->name('tests.delete');
