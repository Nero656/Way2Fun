<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\ActivityDate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AvailableSeat>
 */
class AvailableSeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'activity_id' => Activity::inRandomOrder()->value('id') ?? Activity::factory(),
            'activity_date_id' => ActivityDate::inRandomOrder()->value('id') ?? ActivityDate::factory(),
            'available_seats' => $this->faker->numberBetween(5, 100),
        ];
    }
}
