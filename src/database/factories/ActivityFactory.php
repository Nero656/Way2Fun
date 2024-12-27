<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Booking;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    protected $model = Activity::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->text(200),
            'short_description' => $this->faker->text(50),
            'price' => $this->faker->randomFloat(2, 10, 500), // Цена от 10 до 500
            'duration' => $this->faker->numberBetween(30, 180), // Продолжительность от 30 до 180 минут
            'capacity' => $this->faker->numberBetween(5, 30), // Вместимость от 5 до 30 участников
            'guide_id' => User::where('role_id', 1)->inRandomOrder()->first()->id, // Случайный гид (например, роль админа или гид)
            'city_id' => City::inRandomOrder()->first()->id, // Случайный город
            'category_id' => Category::inRandomOrder()->first()->id, // Случайная категория
        ];
    }
}
