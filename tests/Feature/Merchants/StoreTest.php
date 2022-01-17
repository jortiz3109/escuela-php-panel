<?php

namespace Tests\Feature\Merchants;

use App\Constants\PermissionType;
use App\Models\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\Concerns\MerchantHasDataProvider;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;
    use MerchantHasDataProvider;

    private const MERCHANT_PERMISSION = Merchant::PERMISSIONS[PermissionType::CREATE];

    public function test_a_guest_user_cannot_access(): void
    {
        $fakeMerchantData = $this->fakeMerchantData();

        $this->post(Merchant::urlPresenter()->store(), $fakeMerchantData)
            ->assertRedirect(route('login'));

        $this->assertDatabaseMissing('merchants', $fakeMerchantData);
    }

    public function test_an_user_without_permissions_cannot_store_a_merchant(): void
    {
        $fakeMerchantData = $this->fakeMerchantData();

        $this->actingAs($this->defaultUser())->post(Merchant::urlPresenter()->store(), $fakeMerchantData)
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseMissing('merchants', $fakeMerchantData);
    }

    public function test_it_can_store_merchants(): void
    {
        $fakeMerchantData = $this->fakeMerchantData();

        $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))
            ->post(Merchant::urlPresenter()->store(), $fakeMerchantData)
            ->assertRedirect(Merchant::urlPresenter()->show(Merchant::latest()->first()));

        $this->assertDatabaseHas('merchants', $fakeMerchantData);
    }
}
