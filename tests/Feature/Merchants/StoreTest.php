<?php

namespace Tests\Feature\Merchants;

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
        $this->post(route(self::MERCHANTS_ROUTE_NAME))
            ->assertRedirect(route('login'));
    }

    public function test_it_can_store_merchants(): void
    {
        $this->actingAs($this->defaultUser())
            ->post(route(self::MERCHANTS_ROUTE_NAME), $this->fakeMerchantData())
            ->assertRedirect();
    }
}
