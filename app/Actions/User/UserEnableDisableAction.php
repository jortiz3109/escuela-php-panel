<?php

namespace App\Actions\User;

use App\Models\User;

class UserEnableDisableAction
{
    public function execute(User $user, string|null $status): User
    {
        $user->email_verified_at = $user->isEmailVerified($user) ? $status : null;

        $user->save();

        return $user;
    }
}
