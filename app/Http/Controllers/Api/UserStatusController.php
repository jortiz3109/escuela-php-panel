<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserStatusController extends Controller
{
    public function toggle(User $user): User
    {
        if ($user->isEnabled()) {
            $user->markAsDisabled();
        } else {
            $user->markAsEnabled();
        }

        return $user;
    }
}
