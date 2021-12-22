<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Currency::class;

    private array $names = [
        'Afghan afghani',
        'Brazilian real',
        'Colombian peso',
        'Dominican peso',
        'United States dollar',
        'Euro',
    ];

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement($this->names),
            'minor_unit' => 2,
            'alphabetic_code' => $this->faker->unique()->currencyCode(),
            'numeric_code' => $this->faker->unique()->bothify('###'),
            'symbol' => '$',
        ];
    }
}
