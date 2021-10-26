<?php

namespace Database\Factories;

use App\Models\KnowDevice;
use Illuminate\Database\Eloquent\Factories\Factory;

class KnowDeviceFactory extends Factory
{
    protected $model = KnowDevice::class;

    public function definition(): array
    {
        return [
            'user_agent' => $this->faker->userAgent(),
            'last_login_at' => $this->faker->dateTimeBetween('-1 week', '-1 day'),
            'created_at' => $this->faker->dateTimeBetween('-1 week', '-1 day'),
        ];
    }
}
