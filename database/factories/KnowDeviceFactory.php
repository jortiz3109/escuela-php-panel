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
            'last_login_at' => $this->faker->dateTime(),
            'created_at' => $this->faker->dateTimeBetween('-1 week', '-1 day'),
        ];
    }

    public function recent(): Factory
    {
        return $this->state(function () {
            return [
                'last_login_at' => $this->faker->dateTimeBetween('-1 week', '-1 day'),
            ];
        });
    }

    public function ancient(): Factory
    {
        $elapsedMonths = config('auth.months_elapsed_to_consider_a_device_as_ancient', 6);

        return $this->state(function () use ($elapsedMonths) {
            return [
                'last_login_at' => $this->faker->dateTimeBetween('-1 year', '-' . $elapsedMonths . ' months'),
            ];
        });
    }
}
