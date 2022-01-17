<?php

namespace Tests\Feature\Concerns;

use App\Models\User;

trait HasAuthenticatedUser
{
    public function defaultUser(): User
    {
        return User::factory()->verified()->create(['email' => 'test@test.com']);
    }

    public function enabledUser(): User
    {
        return User::factory()->enabled()->create();
    }
}
