<?php

namespace Database\Seeders;

use App\Models\ActivityDate;
use Illuminate\Database\Seeder;

class ActivityDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ActivityDate::factory()->count(500)->create();
    }
}
