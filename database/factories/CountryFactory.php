<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->country(),
            'alpha_two_code' => $this->faker->countryCode(),
            'alpha_three_code' => $this->faker->countryISOAlpha3(),
            'numeric_code' => $this->faker->bothify('###'),
        ];
    }
}
