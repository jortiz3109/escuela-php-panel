<?php

namespace App\Policies;

use App\Constants\PermissionType;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionType::TRANSACTION_INDEX);
    }

    public function view(User $user, Transaction $transaction): bool
    {
        return $user->hasPermission(PermissionType::TRANSACTION_SHOW);
    }
}
