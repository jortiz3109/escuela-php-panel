<?php

namespace Tests\Feature\Merchants;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;
    use MerchantTestHelper;

    public function test_a_guest_user_cannot_access(): void
    {
        $this->put($this->fakeMerchant()->presenter()->update())
            ->assertRedirect(route('login'));
    }

    public function test_it_can_update_merchants(): void
    {
        $merchant = $this->fakeMerchant();
        $fakeMerchantData = $this->fakeMerchantData();

        $this->actingAs($this->defaultUser())
            ->put($merchant->presenter()->update(), $fakeMerchantData)
            ->assertRedirect();

        $this->assertDatabaseHas('merchants', [
            'id' => $merchant->getKey(),
        ] + $fakeMerchantData);
    }
}
