<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Хешированный пароль по умолчанию
        ];
    }

    // Пример метода для создания пользователя с заданным паролем
    public function withPassword(string $password)
    {
        return $this->state([
            'password' => bcrypt($password),
        ]);
    }

    // Пример метода для создания пользователя с конкретной ролью
    public function withRole(string $role)
    {
        return $this->state([
            'role' => $role, // Предполагается, что в модели User есть поле role
        ]);
    }
}
