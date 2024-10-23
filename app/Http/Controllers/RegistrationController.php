<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use App\Services\RabbitMQService;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    private RabbitMQService $rabbitMQService;

    public function __construct(RabbitMQService $rabbitMQService)
    {
        $this->rabbitMQService = $rabbitMQService;
    }
    // Показать форму регистрации
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Обработка регистрации
    public function register(RegistrationRequest $request)
    {
        // Создаем пользователя
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), // Хэшируем пароль
        ]);

        // Отправляем данные в очередь RabbitMQ
        $this->rabbitMQService->sendEmail('email_queue', $user->email, $user->id, 'emails.welcome');

        // Можно автоматически залогинить пользователя или перенаправить на главную страницу
        // auth()->login($user);

        return redirect('/')->with('success', 'Регистрация успешна!');
    }
}
