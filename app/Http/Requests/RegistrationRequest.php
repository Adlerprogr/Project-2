<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Разрешаем выполнение запроса
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
//            'password' => ['required', 'string', 'min:8', 'confirmed', Password::min(8)->letters()->numbers()->mixedCase()->symbols()],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Введите ваше имя.',
            'last_name.required' => 'Введите вашу фамилию.',
            'email.required' => 'Введите ваш email.',
            'email.email' => 'Введите корректный email.',
            'email.unique' => 'Пользователь с таким email уже существует.',
            'password.required' => 'Введите пароль.',
            'password.min' => 'Пароль должен содержать не менее 8 символов.',
            'password.confirmed' => 'Пароли не совпадают.',
        ];
    }
}
