<?php

namespace Tests\Feature\Merchants;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\HasMerchants;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    use HasMerchants;

    private const MERCHANTS_ROUTE_NAME = 'merchants.show';

    public function test_an_user_authenticated_can_show_merchant_view(): void
    {
        $country = Country::factory()->create();
        $currency = Currency::factory()->create();

        $merchant = Merchant::factory()
            ->for($country)
            ->for($currency)
            ->create();

        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $merchant->getKey()));

        $response
            ->assertSee($merchant->name)
            ->assertSee($merchant->brand)
            ->assertSee($merchant->document)
            ->assertSee($merchant->url)
            ->assertSee($merchant->country->name)
            ->assertSee($merchant->currency->alphabetic_code)
            ->assertSee(route('merchants.edit', $merchant->getKey()))
            ->assertSee(route('merchants.index'))
            ->assertStatus(200);
    }

    public function test_a_guest_user_cannot_access(): void
    {
        $this->createMerchants();
        $merchant = Merchant::first();
        $response = $this->get(route(self::MERCHANTS_ROUTE_NAME, $merchant->getKey()));
        $response->assertRedirect(route('login'));
    }
}
