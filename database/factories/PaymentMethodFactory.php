<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentMethodFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->creditCardType(),
            'logo' => $this->faker->imageUrl(),
        ];
    }
}
