<?php

namespace App\Policies;

use App\Constants\PermissionType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MerchantPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionType::MERCHANT_INDEX);
    }

    public function view(User $user): bool
    {
        return $user->hasPermission(PermissionType::MERCHANT_SHOW);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionType::MERCHANT_CREATE);
    }

    public function update(User $user): bool
    {
        return $user->hasPermission(PermissionType::MERCHANT_UPDATE);
    }
}
