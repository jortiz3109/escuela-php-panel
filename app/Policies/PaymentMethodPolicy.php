<?php

namespace App\Policies;

use App\Constants\PermissionType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentMethodPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionType::PAYMENT_METHOD_INDEX);
    }
}
