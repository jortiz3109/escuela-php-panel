<?php

namespace Tests\Feature\Merchants;

use App\Constants\PermissionType;
use App\Models\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\Concerns\MerchantHasDataProvider;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;
    use MerchantHasDataProvider;

    private const MERCHANT_PERMISSION = Merchant::PERMISSIONS[PermissionType::UPDATE];

    public function test_a_guest_user_cannot_access(): void
    {
        $merchant = $this->createMerchantWithData();
        $fakeMerchantData = $this->fakeMerchantData();

        $this->put($merchant->presenter()->update())
            ->assertRedirect(route('login'));

        $this->assertDatabaseMissing('merchants', [
                'id' => $merchant->getKey(),
            ] + $fakeMerchantData);
    }

    public function test_an_user_without_permission_cannot_update_a_merchant(): void
    {
        $merchant = $this->createMerchantWithData();
        $fakeMerchantData = $this->fakeMerchantData();

        $this->actingAs($this->defaultUser())->put($merchant->presenter()->update())
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseMissing('merchants', [
                'id' => $merchant->getKey(),
            ] + $fakeMerchantData);
    }

    public function test_it_can_update_merchants(): void
    {
        $merchant = $this->createMerchantWithData();
        $fakeMerchantData = $this->fakeMerchantData();

        $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))
            ->put($merchant->presenter()->update(), $fakeMerchantData)
            ->assertRedirect($merchant->presenter()->show());

        $this->assertDatabaseHas('merchants', [
            'id' => $merchant->getKey(),
        ] + $fakeMerchantData);
    }
}
