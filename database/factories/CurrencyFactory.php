<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'minor_unit' => 2,
            'alphabetic_code' => $this->faker->unique()->currencyCode(),
            'symbol' => '$',
        ];
    }
}
