<?php

namespace Tests\Concerns;

use App\Models\Permission;
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

    public function allowedUser(string $permission): User
    {
        $user = $this->enabledUser();
        $user->permissions()->attach(Permission::firstWhere('name', $permission));

        return $user;
    }
}
