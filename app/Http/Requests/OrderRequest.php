<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Разрешаем выполнение запроса авторизованным пользователям
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'phone' => 'required|string|digits:11',
//            'phone' => ['required', 'string', Phone::class],
            'last_name' => 'required|string|max:50',
            'address' => 'required|string|max:100',
            'city' => 'required|string|max:50',
            'comment' => 'nullable|string|max:255',
            'entrance' => 'required|integer',
            'floor' => 'required|integer',
            'flat' => 'required|integer',
            'intercom' => 'nullable|integer',
            'delivery_date' => 'nullable|date',
            'delivery_time' => 'nullable|time',
        ];
    }

    public function messages(): array
    {
        return [
            'email' => $this->emailMessages(),
            'phone' => $this->phoneMessages(),
            'last_name' => $this->lastNameMessages(),
            'address' => $this->addressMessages(),
            'city' => $this->cityMessages(),
            'entrance' => $this->entranceMessages(),
            'floor' => $this->floorMessages(),
            'flat' => $this->flatMessages(),
        ];
    }

    protected function emailMessages(): array
    {
        return [
            'required' => 'Введите ваш email.',
            'email' => 'Введите корректный email.',
        ];
    }

    protected function phoneMessages(): array
    {
        return [
            'required' => 'Введите ваш телефон.',
            'min' => 'Номер телефона должен содержать 11 цифр.',
            'max' => 'Номер телефона не может превышать 11 цифр.',
        ];
    }

    protected function lastNameMessages(): array
    {
        return [
            'required' => 'Введите вашу фамилию.',
        ];
    }

    protected function addressMessages(): array
    {
        return [
            'required' => 'Введите ваш адрес.',
        ];
    }

    protected function cityMessages(): array
    {
        return [
            'required' => 'Введите ваш город.',
        ];
    }

    protected function entranceMessages(): array
    {
        return [
            'required' => 'Введите номер подъезда.',
            'integer' => 'Номер подъезда должен быть числом.',
        ];
    }

    protected function floorMessages(): array
    {
        return [
            'required' => 'Введите этаж.',
            'integer' => 'Этаж должен быть числом.',
        ];
    }

    protected function flatMessages(): array
    {
        return [
            'required' => 'Введите номер квартиры.',
            'integer' => 'Номер квартиры должен быть числом.',
        ];
    }
}
