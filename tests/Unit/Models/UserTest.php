<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_a_default_disabled_status(): void
    {
        $user = User::factory()->make();

        $this->assertEquals(false, $user->isEnabled());
    }

    public function test_user_has_a_no_verified_email_as_default(): void
    {
        $user = User::factory()->make();

        $this->assertEquals(false, $user->isEmailVerified());
    }

    public function test_user_model_can_change_to_disabled()
    {
        $user = User::factory()->enabled()->make();

        $user->markAsDisabled();

        $this->assertEquals(false, $user->isEnabled());
    }
}
