<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Examtest;
use App\Models\Category;

class ExamtestController extends Controller
{
    public function create(){
        $categories = Category::all();
        return view('pages.forms.newObject',compact('categories'));
    }

    public function store(Request $request)
    {
        // Валидация данных
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:public,restricted,archived',
        ]);

        // Создание записи в таблице examtests
        Examtest::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'author_id' => Auth::id(),
        ]);

        // Редирект с сообщением об успехе
        return redirect()->route('create_new_test')->with('success', 'Тест успешно создан!');
    }
}
