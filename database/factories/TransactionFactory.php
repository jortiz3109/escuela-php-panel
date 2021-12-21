<?php

namespace Database\Factories;

use App\Constants\TransactionStatus;
use App\Models\Currency;
use App\Models\Merchant;
use App\Models\PaymentMethod;
use App\Models\Person;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'merchant_id' => Merchant::factory(),
            'payer_id' => Person::factory(),
            'buyer_id' => Person::factory(),
            'payment_method_id' => PaymentMethod::inRandomOrder()->first()->id,
            'currency_id' => Currency::all()->random()->id,
            'reference' => $this->faker->numberBetween(1000000000, 9999999999),
            'card_number' => $this->faker->numerify('######******####'),
            'total_amount' => $this->faker->numberBetween(1, 999999),
            'status' => $this->faker->randomElement(TransactionStatus::STATUSES),
            'ip_address' => $this->faker->ipv4(),
            'date' => $this->faker->dateTime(),
        ];
    }
}
