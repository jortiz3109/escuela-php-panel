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
        return Permission::firstWhere('name', Merchant::PERMISSIONS[PermissionType::INDEX])
            ->users
            ->contains($user);
    }

    public function view(User $user, Merchant $merchant): bool
    {
        return Permission::firstWhere('name', Merchant::PERMISSIONS[PermissionType::SHOW])
            ->users
            ->contains($user);
    }

    public function create(User $user): bool
    {
        return Permission::firstWhere('name', Merchant::PERMISSIONS[PermissionType::CREATE])
            ->users
            ->contains($user);
    }

    public function update(User $user, Merchant $merchant): bool
    {
        return Permission::firstWhere('name', Merchant::PERMISSIONS[PermissionType::UPDATE])
            ->users
            ->contains($user);
    }
}
