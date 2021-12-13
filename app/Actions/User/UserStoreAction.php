<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserStoreAction
{
    public static function execute(array $data, User $user): User
    {
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->created_by = auth()->id();
        $user->updated_by = auth()->id();
        self::isSaved($user);

        return  $user;
    }

    public static function isSaved(User $user): bool
    {
        $user->save() ? event(new Registered($user)) : Log::error(trans(''));

        return $user->save();
    }
}
