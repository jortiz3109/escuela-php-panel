<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ToggleStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_toggle_user_status(): void
    {
        $user = $this->enabledUser();

        $this->assertTrue($user->isEnabled());

        $this->actingAs($user)->get(route('users.toggleStatus', [1]))
            ->assertStatus(Response::HTTP_OK);

        $user = $user->fresh();
        $this->assertFalse($user->isEnabled());

        $this->actingAs($user)->get(route('users.toggleStatus', [1]))
            ->assertStatus(Response::HTTP_OK);

        $user = $user->fresh();
        $this->assertTrue($user->isEnabled());
    }
}
