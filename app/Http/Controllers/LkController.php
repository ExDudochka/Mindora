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
}
