<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Currency;
use App\Models\DocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class MerchantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'document_type_id' => DocumentType::inRandomOrder()->first()->id,
            'document' => $this->faker->unique()->bothify('###########'),
            'name' => $this->faker->company(),
            'brand' => $this->faker->bs(),
            'url' => $this->faker->url(),
            'logo' => $this->faker->image(null, 100, 100),
            'country_id'  => Country::inRandomOrder()->first()->id,
            'currency_id' => Currency::inRandomOrder()->first()->id,
        ];
    }
}
