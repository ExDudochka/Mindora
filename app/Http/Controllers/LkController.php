<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Examtest;

class LkController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // всегда текущий авторизованный

        $userTests = Examtest::with(['category', 'questions'])
            ->where('author_id', $user->id)
            ->get();

        $title = 'Личный кабинет | ' . $user->login;

        return view('pages.lk', compact('user', 'title', 'userTests'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users,login,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
        ]);

        $user->update($data);

        // Можно вернуть редирект обратно с сообщением
        return redirect()->back()->with('success', 'Данные профиля успешно обновлены');
    }
}
