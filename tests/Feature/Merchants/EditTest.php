<?php

namespace Tests\Feature\Merchants;

use App\Models\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;
    use MerchantTestHelper;

    public function test_a_guest_user_cannot_access(): void
    {
        $merchant = $this->fakeMerchant();

        $this->get(Merchant::urlPresenter()->edit($merchant))
            ->assertRedirect(route('login'));
    }

    public function test_it_can_edit_merchants(): void
    {
        $merchant = $this->fakeMerchant();

        $this->actingAs($this->defaultUser())->get(Merchant::urlPresenter()->edit($merchant))
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_it_loads_default_merchant_data(): void
    {
        $merchant = $this->fakeMerchant();

        $this->actingAs($this->defaultUser())->get(Merchant::urlPresenter()->edit($merchant))
            ->assertSee($merchant->name)
            ->assertSee($merchant->brand)
            ->assertSee($merchant->document)
            ->assertSee($merchant->url);
    }
}
