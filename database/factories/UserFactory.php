<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): Factory
    {
        return $this->state(function () {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function verified(): Factory
    {
        return $this->state(function () {
            return [
                'email_verified_at' => $this->faker->dateTime(),
            ];
        });
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
