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

    public function test_a_guest_user_cannot_access(): void
    {
        $fakeMerchantData = $this->fakeMerchantData();

        $this->post(Merchant::urlPresenter()->store(), $fakeMerchantData)
            ->assertRedirect(route('login'));

        $this->assertDatabaseMissing('merchants', $fakeMerchantData);
    }

    public function test_it_can_store_merchants(): void
    {
        $fakeMerchantData = $this->fakeMerchantData();

        $this->actingAs($this->defaultUser())
            ->post(Merchant::urlPresenter()->store(), $fakeMerchantData)
            ->assertRedirect(Merchant::urlPresenter()->show(Merchant::latest()->first()));

        $this->assertDatabaseHas('merchants', $fakeMerchantData);
    }
}
