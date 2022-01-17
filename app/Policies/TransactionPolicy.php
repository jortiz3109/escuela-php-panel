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

    public function viewAny(User $user): bool
    {
        return Permission::firstWhere('name', PermissionType::TRANSACTION_INDEX)
            ->users
            ->contains($user);
    }

    public function view(User $user, Transaction $transaction): bool
    {
        return Permission::firstWhere('name', PermissionType::TRANSACTION_SHOW)
            ->users
            ->contains($user);
    }
}
