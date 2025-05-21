<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CitySeeder::class,
            CategorySeeder::class,
            ActivitySeeder::class,
            BookingSeeder::class,
            ReviewSeeder::class,
            ActivityDateSeeder::class,
            AddressSeeder::class,
            AvailableSeatSeeder::class,
        ]);
    }
}
