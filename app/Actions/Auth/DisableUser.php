<?php

namespace App\Actions\Auth;

use App\Models\User;

class DisableUser
{
    public static function execute(string $userEmail): void
    {
        $user = User::where('email', $userEmail)->firstOrFail();

        $user->markAsDisabled();
    }
}
