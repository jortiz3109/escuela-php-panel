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

    private const MERCHANTS_ROUTE_NAME = 'merchants.edit';

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(route(self::MERCHANTS_ROUTE_NAME, $this->fakeMerchant()));
        $response->assertRedirect(route('login'));
    }

    public function test_it_can_create_merchants(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $this->fakeMerchant()));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_loads_default_merchant_data(): void
    {
        $merchant = $this->fakeMerchant();

        $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME, $merchant))
            ->assertSee($merchant->name)
            ->assertSee($merchant->brand)
            ->assertSee($merchant->document)
            ->assertSee($merchant->url);
    }

    public function fakeMerchant(array $attributes = []): Merchant
    {
        return Merchant::factory()->create($attributes);
    }
}
