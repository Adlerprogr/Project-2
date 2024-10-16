<?php

namespace App\Http\Controllers;

use App\Mail\MyMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    // Показать форму регистрации
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Обработка регистрации
    public function register(Request $request)
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

        // Отправляем письмо подтверждения
        Mail::to($user->email)->send(new MyMail($user, 'emails.welcome'));

        // Можно автоматически залогинить пользователя или перенаправить на страни
        // auth()->login($user);

         return redirect('/')->with( 'success', 'Регистрация успешна!');
    }
}
