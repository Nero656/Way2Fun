<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // Генерация случайного количества бронирований (от 10 до 25)
        $bookingsCount = rand(10, 25);

        $bookings = [];

        for ($i = 0; $i < $bookingsCount; $i++) {
            $bookings[] = [
                'date' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
                'time' => $faker->time('H:i:s'),
                'user_id' => $faker->numberBetween(1, 100), // Предполагается, что есть до 100 пользователей
                'activity_id' => $faker->numberBetween(1, 13),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        // Вставка данных в таблицу bookings
        DB::table('bookings')->insert($bookings);
    }
}
