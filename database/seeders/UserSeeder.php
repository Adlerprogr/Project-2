<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Создайте 10 пользователей с помощью фабрики
        User::factory()->count(10)->create();
    }
}
