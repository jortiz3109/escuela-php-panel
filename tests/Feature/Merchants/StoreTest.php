<?php

namespace Tests\Feature\Merchants;

use App\Models\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;
    use MerchantTestHelper;

    public const MERCHANTS_ROUTE_NAME = 'merchants.store';

    public function test_a_guest_user_cannot_access(): void
    {
        $fakeMerchantData = $this->fakeMerchantData();

        $this->post(route(self::MERCHANTS_ROUTE_NAME), $fakeMerchantData)
            ->assertRedirect(route('login'));

        unset($fakeMerchantData['uuid']);

        $this->assertDatabaseMissing('merchants', $fakeMerchantData);
    }

    public function test_it_can_store_merchants(): void
    {
        $fakeMerchantData = $this->fakeMerchantData();

        $this->actingAs($this->defaultUser())
            ->post(route(self::MERCHANTS_ROUTE_NAME), $fakeMerchantData)
            ->assertRedirect(route('merchants.show', Merchant::latest()->first()));

        unset($fakeMerchantData['uuid']);

        $this->assertDatabaseHas('merchants', $fakeMerchantData);
    }
}
