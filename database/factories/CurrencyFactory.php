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

    public function enabled(): Factory
    {
        return $this->state(function () {
            return [
                'enabled_at' => $this->faker->dateTime(),
            ];
        });
    }

    public function disabled(): Factory
    {
        return $this->state(function () {
            return [
                'enabled_at' => null,
            ];
        });
    }
}
