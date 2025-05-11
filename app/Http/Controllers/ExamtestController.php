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

    public function store(Request $r)
    {
        $validated = $r->validate([
            'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:public,restricted,archived',
            'questions' => 'required|array|min:1',
            'questions.*.content' => 'required|string',
            'questions.*.type' => 'required|in:single,multiple,text',
        ]);

        // Проверка наличия options для вопросов с выбором
        foreach ($r->questions as $q) {
            if (in_array($q['type'], ['single', 'multiple']) && empty($q['options'])) {
                return back()->withErrors(['questions' => 'Для вопросов с выбором укажите варианты ответов']);
            }
        }

        // Создаём тест
        $test = Examtest::create([
            'title' => $r->title,
            'description' => $r->description,
            'category_id' => $r->category_id,
            'status' => $r->status,
            'author_id' => Auth::id(),
        ]);

        // Сохраняем вопросы и опции
        foreach ($r->questions as $i => $q) {
            $question = $test->questions()->create([
                'content' => $q['content'],
                'type' => $q['type'],
                'position' => $i + 1,
            ]);

            if (in_array($q['type'], ['single', 'multiple'])) {
                foreach ($q['options'] as $j => $opt) {
                    $question->options()->create([
                        'content' => $opt['text'],
                        'is_correct' => !empty($q['options'][$j]['correct']),
                    ]);
                }
            }
        }

        return redirect()->route('home')->with('success', 'Тест сохранён');
    }
}
