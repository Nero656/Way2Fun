<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $streetTypes = ['ул.', 'пр-т', 'переулок', 'бульвар', 'пл.'];
        $streetNames = [
            'Ленина', 'Пушкина', 'Гагарина', 'Советская', 'Мира', 'Космонавтов',
            'Трудовая', 'Набережная', 'Школьная', 'Зелёная', 'Чехова', 'Садовая',
            'Октябрьская', 'Победы', 'Кирова'
        ];

        return [
            'city_id' => City::query()->inRandomOrder()->value('id') ?? City::factory(),
            'street' => $this->faker->randomElement($streetTypes) . ' ' . $this->faker->randomElement($streetNames),
            'building' => $this->faker->numberBetween(1, 150),
            'postal_code' => $this->faker->postcode(),
        ];
    }
}
