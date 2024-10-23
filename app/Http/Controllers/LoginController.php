<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Показать форму логина
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Обработка входа
    public function login(LoginRequest $request)
    {
        // Валидация данных
        $credentials = $request->only('email', 'password');

        // Попытка аутентификации
        if (Auth::attempt($credentials)) {
            // Аутентификация успешна
            return redirect()->intended('/main');
        }

        // Если логин неудачен, возвращаемся с ошибкой
        return back()->withErrors([
            'email' => 'Неверный email или пароль.',
        ])->onlyInput('email');
    }

    // обработка выхода
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Вы вышли из системы.');
    }
}
