<?php

namespace App\Actions\User;

use App\Models\User;

class UserVerificationAction
{
    public function execute(User $user, string|null $status): User
    {
        $user->email_verified_at = $user->isEmailVerified() ? $status : null;

        $user->save();

        return $user;
    }
}
