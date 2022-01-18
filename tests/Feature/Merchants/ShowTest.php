<?php

namespace Tests\Feature\Merchants;

use App\Constants\PermissionType;
use App\Models\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\Concerns\MerchantHasDataProvider;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;
    use MerchantHasDataProvider;

    private const MERCHANT_PERMISSION = PermissionType::MERCHANT_SHOW;

    public function test_a_guest_user_cannot_access(): void
    {
        $merchant = $this->createMerchantWithData();

        $this->get(Merchant::urlPresenter()->show($merchant))
            ->assertRedirect(route('login'));
    }

    public function test_an_user_without_permission_cannot_see_a_merchant(): void
    {
        $this->actingAs($this->defaultUser())
            ->get(Merchant::urlPresenter()->show($this->createMerchantWithData()))
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_an_allowed_user_can_see_merchant(): void
    {
        $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))
            ->get(Merchant::urlPresenter()->show($this->createMerchantWithData()))
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_an_allowed_user_can_see_show_view(): void
    {
        $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))
            ->get(Merchant::urlPresenter()->show($this->createMerchantWithData()))
            ->assertViewIs('modules.show');
    }

    public function test_an_allowed_user_can_see_merchant_data(): void
    {
        $merchant = $this->createMerchantWithData();

        $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))
            ->get(Merchant::urlPresenter()->show($merchant))
            ->assertSee($merchant->name)
            ->assertSee($merchant->brand)
            ->assertSee($merchant->document)
            ->assertSee($merchant->url)
            ->assertSee($merchant->country->name)
            ->assertSee($merchant->currency->alphabetic_code);
    }

    public function test_an_allowed_user_can_see_action_buttons(): void
    {
        $merchant = $this->createMerchantWithData();

        $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))
            ->get(Merchant::urlPresenter()->show($merchant))
            ->assertSeeText(trans('buttons.actions.edit'))
            ->assertSee(Merchant::urlPresenter()->edit($merchant))
            ->assertSeeText(trans('buttons.actions.back'))
            ->assertSee(Merchant::urlPresenter()->index());
    }
}
