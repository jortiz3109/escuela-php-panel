<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_a_disabled_default_status()
    {
        $user = User::factory()->make();

        $this->assertEquals(false, $user->isEnabled());
    }
}
