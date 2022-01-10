<?php

namespace App\Policies;

use App\Constants\PermissionType;
use App\Models\Permission;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return Permission::firstWhere('name', Transaction::PERMISSIONS[PermissionType::INDEX])
            ->users
            ->contains($user);
    }

    public function view(User $user, Transaction $transaction)
    {
        return Permission::firstWhere('name', Transaction::PERMISSIONS[PermissionType::SHOW])
            ->users
            ->contains($user);
    }
}
