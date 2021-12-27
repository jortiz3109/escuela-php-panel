<?php

namespace Tests\Feature\Merchants;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    private const MERCHANTS_ROUTE_NAME = 'merchants.create';

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get(route(self::MERCHANTS_ROUTE_NAME));
        $response->assertRedirect(route('login'));
    }

    public function test_it_can_create_merchants(): void
    {
        $response = $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_shows_fields_to_create_merchants(): void
    {
        $this->actingAs($this->defaultUser())->get(route(self::MERCHANTS_ROUTE_NAME))
            ->assertSee(trans('merchants.placeholders.name'))
            ->assertSee(trans('merchants.placeholders.brand'))
            ->assertSee(trans('merchants.placeholders.document'))
            ->assertSee(trans('merchants.placeholders.url'))
            ->assertSee(trans('merchants.placeholders.country'))
            ->assertSee(trans('merchants.placeholders.currency'));
    }
}
