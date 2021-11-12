<?php

namespace Database\Factories;

use App\Enums\TransactionStatusEnum;
use App\Models\Currency;
use App\Models\Merchant;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'merchant_id' => Merchant::factory()->create()->id,

            'reference' => $this->faker->numberBetween(1000000000, 9999999999),

            'card_number' => $this->faker->numerify('************####'),

            'payment_method_id' => PaymentMethod::firstOrCreate(
                ['name' => 'VISA DEBIT'],
                ['logo' => 'https://seeklogo.com/images/V/visa-electron-logo-71BEC57E8F-seeklogo.com.png'],
            ),

            'total_amount' => $this->faker->numberBetween(1, 999999),

            'currency_id' => Currency::firstOrCreate(
                ['name' => 'US dollar'],
                ['minor_unit' => 2, 'alphabetic_code' => 'USD', 'numeric_code' => '840'],
            ),

            'status' => $this->faker->randomElement(TransactionStatusEnum::STATUSES),

            'ip_address' => $this->faker->ipv4(),

            'payer' => json_encode([
                'name' => $this->faker->name(),
                'email' => $this->faker->email(),
            ]),

            'buyer' => json_encode([
                'name' => $this->faker->name(),
                'email' => $this->faker->email(),
            ]),
        ];
    }
}
