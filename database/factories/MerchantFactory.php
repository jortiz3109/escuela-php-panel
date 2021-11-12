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
            'uuid'        => $this->faker->uuid(),
            'document'    => $this->faker->unique()->bothify('###########'),
            'name'        => $this->faker->company(),
            'brand'       => $this->faker->bs(),
            'url'         => $this->faker->url(),
            'logo'        => $this->faker->image(null, 100, 100),
            'country_id'  => Country::factory()->create()->id,
            'currency_id' => Currency::factory()->create()->id,
        ];
    }
}
