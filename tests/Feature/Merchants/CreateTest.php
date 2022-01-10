<?php

namespace Tests\Feature\Merchants;

use App\Constants\PermissionType;
use App\Models\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    private const MERCHANTS_ROUTE_NAME = 'merchants.create';
    private const MERCHANT_PERMISSION = Merchant::PERMISSIONS[PermissionType::CREATE];

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(route(self::MERCHANTS_ROUTE_NAME));
        $response->assertRedirect(route('login'));
    }

    public function test_an_user_without_permission_cannot_access(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME));
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_it_can_create_merchants(): void
    {
        $response = $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))->get(route(self::MERCHANTS_ROUTE_NAME));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_shows_fields_to_create_merchants(): void
    {
        $this->actingAs($this->allowedUser(self::MERCHANT_PERMISSION))->get(route(self::MERCHANTS_ROUTE_NAME))
            ->assertSee(trans('merchants.placeholders.name'))
            ->assertSee(trans('merchants.placeholders.brand'))
            ->assertSee(trans('merchants.placeholders.document'))
            ->assertSee(trans('merchants.placeholders.url'))
            ->assertSee(trans('merchants.placeholders.country'))
            ->assertSee(trans('merchants.placeholders.currency'));
    }
}
