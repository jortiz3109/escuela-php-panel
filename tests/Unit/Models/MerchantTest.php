<?php

namespace Tests\Unit\Models;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Merchant;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MerchantTest extends TestCase
{
    use RefreshDatabase;

    public function test_belongs_to_a_country(): void
    {
        $merchant = Merchant::factory()->create();
        $this->assertInstanceOf(Country::class, $merchant->country);
    }

    public function test_belongs_to_a_currency(): void
    {
        $merchant = Merchant::factory()->create();
        $this->assertInstanceOf(Currency::class, $merchant->currency);
    }

    public function test_has_many_transactions(): void
    {
        $merchant = Merchant::factory()->create();
        $transaction = Transaction::factory()->for($merchant, 'merchant')->create();

        $this->assertTrue($merchant->transactions->contains($transaction));
        $this->assertEquals(1, $merchant->transactions->count());
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $merchant->transactions
        );
    }
}
