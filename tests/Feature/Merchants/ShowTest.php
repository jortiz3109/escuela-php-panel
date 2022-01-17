<?php

namespace Tests\Feature\Merchants;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;
    use MerchantTestHelper;

    public function test_a_guest_user_cannot_access(): void
    {
        $merchant = $this->fakeMerchant();

        $this->get(Merchant::urlPresenter()->show($merchant))
            ->assertRedirect(route('login'));
    }

    public function test_an_user_authenticated_can_show_merchant_view(): void
    {
        $merchant = $this->fakeMerchant();

        $this->actingAs($this->defaultUser())->get(Merchant::urlPresenter()->show($merchant))
            ->assertSee($merchant->name)
            ->assertSee($merchant->brand)
            ->assertSee($merchant->document)
            ->assertSee($merchant->url)
            ->assertSee($merchant->country->name)
            ->assertSee($merchant->currency->alphabetic_code)
            ->assertSee(Merchant::urlPresenter()->edit($merchant))
            ->assertSee(route('merchants.index'))
            ->assertStatus(200);
    }
}
