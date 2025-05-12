<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Examtest;

class CardController extends Controller
{
    public function index()
    {
        // Получаем все тесты с подсчётом количества вопросов
        $examtests = Examtest::with(['category', 'author'])->withCount('questions')->get();

        // Передаём их во view
        return view('pages.home', compact('examtests'));
    }
}
