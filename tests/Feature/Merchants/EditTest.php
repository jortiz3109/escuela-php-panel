<?php

namespace Tests\Feature\Merchants;

use App\Constants\PermissionType;
use App\Models\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\Concerns\MerchantHasDataProvider;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;
    use MerchantHasDataProvider;

    private const MERCHANT_PERMISSION = Merchant::PERMISSIONS[PermissionType::UPDATE];

    public function test_a_guest_user_cannot_access(): void
    {
        $this->get(Merchant::urlPresenter()
            ->edit($this->createMerchantWithData()))
            ->assertRedirect(route('login'));
    }

    public function test_an_user_without_permission_cannot_create_a_merchant(): void
    {
        $this->actingAs($this->defaultUser())
            ->get(Merchant::urlPresenter()->edit($this->createMerchantWithData()))
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_it_can_edit_merchants(): void
    {
        $merchant = $this->createMerchantWithData();

        $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))
            ->get(Merchant::urlPresenter()->edit($merchant))
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_it_loads_default_merchant_data(): void
    {
        $merchant = $this->createMerchantWithData();

        $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))
            ->get(Merchant::urlPresenter()->edit($merchant))
            ->assertSee($merchant->name)
            ->assertSee($merchant->brand)
            ->assertSee($merchant->document)
            ->assertSee($merchant->url);
    }
}
