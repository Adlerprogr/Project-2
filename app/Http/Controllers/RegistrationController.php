<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegistrationRequest $request)
    {
        try {
            // Создаем пользователя
            $user = User::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            // Данные для email
            $data = ['user' => $user];

            // Отправляем Job в очередь
            SendEmailJob::dispatch($data['user']->email, $data, 'emails.welcome');

//            // Логиним пользователя (опционально)
//             auth()->login($user);

            return redirect('/main')->with('success', 'Регистрация успешна!');
        } catch (\Exception $e) {
            Log::error('Ошибка при регистрации: ' . $e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Ошибка при регистрации. Попробуйте снова.']);
        }
    }
}
