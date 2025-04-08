<?php

namespace Database\Factories;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActivityDate>
 */
class ActivityDateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'activity_id' => Activity::inRandomOrder()->first()->id ?? Activity::factory(),
            'event_date' => Carbon::now()->addDays(rand(0, 365)), // Дата в течение года
        ];
    }
}
