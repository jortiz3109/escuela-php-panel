<?php

namespace App\Policies;

use App\Constants\PermissionType;
use App\Models\Merchant;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MerchantPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return Permission::firstWhere('name', PermissionType::MERCHANT_INDEX)
            ->users
            ->contains($user);
    }

    public function view(User $user, Merchant $merchant): bool
    {
        return Permission::firstWhere('name', PermissionType::MERCHANT_SHOW)
            ->users
            ->contains($user);
    }

    public function create(User $user): bool
    {
        return Permission::firstWhere('name', PermissionType::MERCHANT_CREATE)
            ->users
            ->contains($user);
    }

    public function update(User $user, Merchant $merchant): bool
    {
        return Permission::firstWhere('name', PermissionType::MERCHANT_UPDATE)
            ->users
            ->contains($user);
    }
}
