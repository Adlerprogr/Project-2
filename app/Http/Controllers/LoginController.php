<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        // Попытка аутентификации
        if (Auth::attempt($request->only('email', 'password'))) {
            // Аутентификация успешна
            return redirect()->intended('/main');
        }

        // Если логин неудачен, возвращаемся с ошибкой
        return back()->withErrors([
            'email' => 'Неверный email или пароль.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Вы вышли из системы.');
    }
}
