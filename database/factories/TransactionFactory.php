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
            'merchant_id' => Merchant::firstOrCreate(
                Merchant::factory()->make()->toArray()
            )->id,

            'payer_id' => Person::firstOrCreate(
                Person::factory(['document_number' => '1234567890'])->make()->toArray(),
            )->id,

            'buyer_id' => Person::firstOrCreate(
                Person::factory(['document_number' => '1234567890'])->make()->toArray(),
            )->id,

            'payment_method_id' => PaymentMethod::firstOrCreate(
                ['name' => 'VISA DEBIT'],
                ['logo' => 'https://seeklogo.com/images/V/visa-electron-logo-71BEC57E8F-seeklogo.com.png'],
            ),

            'currency_id' => Currency::firstOrCreate(
                ['name' => 'US dollar'],
                ['minor_unit' => 2, 'alphabetic_code' => 'USD', 'numeric_code' => '840'],
            ),

            'reference' => $this->faker->numberBetween(1000000000, 9999999999),

            'card_number' => $this->faker->numerify('************####'),

            'total_amount' => $this->faker->numberBetween(1, 999999),

            'status' => $this->faker->randomElement(TransactionStatus::STATUSES),

            'ip_address' => $this->faker->ipv4(),

            'created_at' => $this->faker->dateTime(),
        ];
    }
}
