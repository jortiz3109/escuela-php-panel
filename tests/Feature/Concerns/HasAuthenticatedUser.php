<?php

namespace Tests\Feature\Concerns;

use App\Models\User;

trait HasAuthenticatedUser
{
    public function defaultUser(): User
    {
        return User::factory()->create();
    }

    public function enabledUser(): User
    {
        return User::factory()->enabled()->create();
    }
}
