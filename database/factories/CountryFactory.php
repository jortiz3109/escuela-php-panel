<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->country(),
            'alpha_two_code' => $this->faker->unique()->countryCode(),
            'alpha_three_code' => $this->faker->unique()->countryISOAlpha3(),
            'numeric_code' => $this->faker->unique()->bothify('###'),
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
