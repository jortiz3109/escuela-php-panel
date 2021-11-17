<?php

namespace Database\Factories;

use App\Models\DocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class MerchantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid'     => $this->faker->uuid(),
            'document_type_id' => DocumentType::firstOrCreate(
                ['code' => 'ni'],
                ['name' => 'número de identificación tributaria (NIT)'],
            ),
            'document' => $this->faker->unique()->bothify('###########'),
            'name'     => $this->faker->company(),
            'brand'    => $this->faker->bs(),
            'url'      => $this->faker->url(),
            'logo'     => $this->faker->image(null, 100, 100),
        ];
    }
}
