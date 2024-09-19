<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // Показать форму логина
    public function showLoginForm(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('auth.login');
    }

    // Обработка входа
    public function login(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Валидация данных
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Попытка аутентификации
        if (Auth::attempt(['email' =>$credentials['email'], 'password' => $credentials['password']])) {
            // Аутентификация успешна
            return redirect()->intended('/');
        }

        // Если логин неудачен, возвращаемся с ошибкой
        return back()->withErrors([
            'email' => 'Неверный email или пароль.',
        ])->onlyInput(' email');
    }

    // обработка выхода
    public function logout(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Вы вышли из системы.');
    }
}
