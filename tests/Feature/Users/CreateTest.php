<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\Concerns\UserStoreDataProvider;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use UserStoreDataProvider;
    use HasAuthenticatedUser;

    private const USERS_ROUTE_NAME = 'users.create';

    public function test_authenticated_user_can_see_the_create_view(): void
    {
        $this->actingAs($this->defaultUser())->get(route(self::USERS_ROUTE_NAME))
            ->assertStatus(Response::HTTP_OK)
            ->assertViewIs('modules.create');
    }

    public function test_unauthenticated_will_be_redirect_to_login(): void
    {
        $this->get(route(self::USERS_ROUTE_NAME))
            ->assertRedirect(route('login'));
    }

    public function test_it_shows_fields_to_create_users(): void
    {
        $this->actingAs($this->defaultUser())->get(route(self::USERS_ROUTE_NAME))
            ->assertSee(trans('users.placeholders.name'))
            ->assertSee(trans('users.placeholders.email'))
            ->assertSee(trans('users.placeholders.password'))
            ->assertSee(trans('users.placeholders.password_confirmation'));
    }
}
