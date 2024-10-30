<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        // Разрешаем выполнение запроса авторизованным пользователям
        return auth()->check();
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'phone' => 'required|string|min:11|max:11',
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

    public function messages()
    {
        return [
            'email.required' => 'Введите ваш email.',
            'email.email' => 'Введите корректный email.',
            'phone.required' => 'Введите ваш телефон.',
            'phone.min' => 'Номер телефона должен содержать 11 цифр.',
            'last_name.required' => 'Введите вашу фамилию.',
            'address.required' => 'Введите ваш адрес.',
            'city.required' => 'Введите ваш город.',
            'entrance.required' => 'Введите номер подъезда.',
            'floor.required' => 'Введите этаж.',
            'flat.required' => 'Введите номер квартиры.',
        ];
    }
}
