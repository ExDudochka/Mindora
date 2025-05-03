<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/welcome', function () {
    return view('pages.welcome');
})->name('welcome');

Route::get('/home', function () {
    return view('pages.home');
})->name('home');

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::get('/register', [LoginController::class, 'showRegister'])->name('register');

Route::post('/login', [LoginController::class, 'authentication'])->name('llogin');
Route::post('/register', [LoginController::class, 'createRegister'])->name('register');
