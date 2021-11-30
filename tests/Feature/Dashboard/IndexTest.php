<?php

namespace Tests\Feature\Dashboard;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public const DASHBOARD_ROUTE_NAME = 'dashboard';

    public function test_a_guest_user_cannot_access(): void
    {
        $this->get(route(self::DASHBOARD_ROUTE_NAME))
            ->assertRedirect(route('login'));
    }

    public function test_a_authenticated_user_can_access(): void
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route(self::DASHBOARD_ROUTE_NAME))
            ->assertStatus(Response::HTTP_OK);
    }
}
