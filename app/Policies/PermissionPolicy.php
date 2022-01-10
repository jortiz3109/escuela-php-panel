<?php

namespace App\Policies;

use App\Constants\PermissionType;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return Permission::firstWhere('name', Permission::PERMISSIONS[PermissionType::INDEX])
            ->users
            ->contains($user);
    }

    public function update(User $user, Permission $permission)
    {
        return Permission::firstWhere('name', Permission::PERMISSIONS[PermissionType::UPDATE])
            ->users
            ->contains($user);
    }
}
