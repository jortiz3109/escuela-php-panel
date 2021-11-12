<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

class MerchantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'document' => $this->faker->unique()->bothify('###########'),
            'name' => $this->faker->company(),
            'brand' => $this->faker->bs(),
            'url' => $this->faker->url(),
            'logo' => $this->faker->image(null, 100, 100),

            'country_id'  => Country::firstOrCreate(
                Country::factory()->make()->toArray()
            )->id,

            'currency_id' => Currency::firstOrCreate(
                Currency::factory()->make()->toArray()
            )->id,
        ];
    }
}
