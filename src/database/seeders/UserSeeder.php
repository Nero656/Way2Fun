<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем администратора
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'telephone' => '1234567890',
            'email_verified_at' => now(),
            'password' => 'admin',
            'role_id' => 1, // Администратор
        ]);

        // Создаем 99 случайных пользователей
        User::factory(99)->create();
    }
}
