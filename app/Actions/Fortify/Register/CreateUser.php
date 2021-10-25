<?php

namespace App\Actions\Logins;

use App\Models\LoginLog;

class CreateUser
{
    public static function execute(array $user): void
    {
        $user = User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $user['password'],
            'created_by' =>  $user['created_by'],
            'updated_by' =>   $user['updated_by'],
        ]);

        event(new Registered($user));
    }
}