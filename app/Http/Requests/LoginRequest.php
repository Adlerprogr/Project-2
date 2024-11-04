<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Разрешаем запросы только авторизованным пользователям
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'email' => $this->emailMessages(),
            'password' => $this->passwordMessages(),
        ];
    }

    protected function emailMessages(): array
    {
        return [
            'required' => 'Поле email обязательно для заполнения.',
            'email' => 'Введите корректный email адрес.',
        ];
    }

    protected function passwordMessages(): array
    {
        return [
            'required' => 'Поле пароль обязательно для заполнения.',
        ];
    }
}
