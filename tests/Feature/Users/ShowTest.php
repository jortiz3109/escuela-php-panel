<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    private const USER_ROUTE_NAME = 'users.show';

    public function test_an_user_authenticated_can_show_user_view(): void
    {
        $user = $this->defaultUser();

        $response = $this->actingAs($this->defaultUser())->get(route(self::USER_ROUTE_NAME, $user->getKey()));

        $response
            ->assertSee($user->name)
            ->assertSee($user->email)
            ->assertSee(trans('common.fields.disabled'))
            ->assertSee(route('users.edit', $user->getKey()))
            ->assertSee(route('users.index'))
            ->assertStatus(200);
    }

    public function test_a_guest_user_cannot_access(): void
    {
        $user = $this->defaultUser();
        $response = $this->get(route(self::USER_ROUTE_NAME, $user->getKey()));
        $response->assertRedirect(route('login'));
    }
}
