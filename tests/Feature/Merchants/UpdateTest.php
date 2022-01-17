<?php

namespace Tests\Feature\Merchants;

use App\Models\Merchant;
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
        $merchant = $this->fakeMerchant();
        $fakeMerchantData = $this->fakeMerchantData();

        $this->put(Merchant::urlPresenter()->update($merchant))
            ->assertRedirect(route('login'));

        $this->assertDatabaseMissing('merchants', [
                'id' => $merchant->getKey(),
            ] + $fakeMerchantData);
    }

    public function test_it_can_update_merchants(): void
    {
        $merchant = $this->fakeMerchant();
        $fakeMerchantData = $this->fakeMerchantData();

        $this->actingAs($this->defaultUser())
            ->put(Merchant::urlPresenter()->update($merchant), $fakeMerchantData)
            ->assertRedirect(Merchant::urlPresenter()->show($merchant));

        $this->assertDatabaseHas('merchants', [
            'id' => $merchant->getKey(),
        ] + $fakeMerchantData);
    }
}
