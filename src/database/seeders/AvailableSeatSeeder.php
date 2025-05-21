<?php

namespace Database\Seeders;

use App\Models\AvailableSeat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvailableSeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AvailableSeat::factory()->count(1000)->create();
    }
}
