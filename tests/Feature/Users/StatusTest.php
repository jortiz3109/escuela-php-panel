<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Feature\Concerns\HasAuthenticatedUser;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthenticatedUser;

    public function test_it_can_toggle_user_status_from_enabled_to_disabled(): void
    {
        $user = $this->enabledUser();

        $this->actingAs($this->enabledUser())->get(route('users.status.toggle', [$user->id]))
            ->assertStatus(Response::HTTP_OK);

        $user = $user->fresh();
        $this->assertFalse($user->isEnabled());
    }

    public function test_it_can_toggle_user_status_from_disabled_to_enabled(): void
    {
        $user = $this->defaultUser();

        $this->actingAs($user)->get(route('users.status.toggle', [$user->id]))
            ->assertStatus(Response::HTTP_OK);

        $user = $user->fresh();
        $this->assertTrue($user->isEnabled());
    }
}
