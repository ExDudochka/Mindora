<?php

namespace App\Http\Controllers;

use App\Models\Examtest;
use App\Models\TestAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassTestController extends Controller
{
    public function show($id)
    {
        $test = Examtest::with(['questions.options'])->findOrFail($id);

        return view('pages.forms.passTest', compact('test'));
    }
    public function submit(Request $request, $id)
    {
        $test = Examtest::with('questions.options')->findOrFail($id);
        $answers = $request->input('answers');

        // Тут можно обработать результаты: сохранить в БД, сравнить с правильными и т.п.
        // Пример вывода:
        return view('forms.testResult', compact('test', 'answers'));
    }
}
