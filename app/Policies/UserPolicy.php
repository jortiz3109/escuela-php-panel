<?php

namespace App\Policies;

use App\Constants\PermissionType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionType::USER_INDEX);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionType::USER_CREATE);
    }

    public function update(User $user): bool
    {
        return $user->hasPermission(PermissionType::USER_UPDATE);
    }
}
