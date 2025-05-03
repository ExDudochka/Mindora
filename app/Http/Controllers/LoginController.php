<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLogin(){
        return view('pages.auth.login');
    }
    public function showRegister(){
        return view('pages.auth.register');
    }

    public function createRegister(Request $request){
        if($request->password !== $request->password_confirmation){
            return back()->with('error', 'Пароли не совпадают');
        }
        $request->validate([
            'phone' => ['required', 'regex:/^\+7\s\(\d{3}\)\s\d{3}-\d{2}-\d{2}$/'],
        ]);

        User::create([
            'name' => $request->name,
            'second_name' => $request->second_name,
            'patronymic' => $request->patronymic,
            'login' => $request->login,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
        ]);

        return redirect()->route('login');
    }

    public function authentication(Request $request){
        $trust = $request->only(['login', 'password']);
        if(Auth::attempt($trust)){
            return redirect()->route('home');
        }
        return response()->json(['error' => 'Неверный логин или пароль']);
    }
}
