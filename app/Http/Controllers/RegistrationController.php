<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    // Показать форму регистрации
    public function showRegistrationForm(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('auth.register');
    }

    // Обработка регистрации
    public function register(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        // Валидация данных
        $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email'=> ' required|string|email|max:255|unique:users',
                'password' => ' required|string|min:8|confirmed',
        ]);

        // Создаем пользователя
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make ($validated['password']), // Хэшируем пароль
        ]);

        // Можно автоматически залогинить пользователя или перенаправить на страни
        // auth()->login($user);

         return redirect('/')->with( 'success', 'Регистрация успешна!');
    }
}
