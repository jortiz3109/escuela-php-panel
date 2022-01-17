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
        return $user->hasPermission(PermissionType::PERMISSION_INDEX);
    }

    public function update(User $user, Permission $permission)
    {
        return $user->hasPermission(PermissionType::PERMISSION_UPDATE);
    }
}
