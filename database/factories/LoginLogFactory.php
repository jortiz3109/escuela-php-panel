<?php

namespace Database\Factories;

use App\Models\LoginLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoginLogFactory extends Factory
{
    protected $model = LoginLog::class;

    public function definition(): array
    {
        return [
            'ip_address' => $this->faker->ipv4(),
            'created_at' => $this->faker->dateTimeBetween('-1 week', '-1 day'),
        ];
    }
}
