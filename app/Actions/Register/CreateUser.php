<?php

namespace App\Actions\Register;

use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;

class CreateUser
{
    public static function execute(array $userRequest): User
    {
        $user = auth()->user()->create([
            'name' => $userRequest['name'],
            'email' => $userRequest['email'],
            'password' => Hash::make($userRequest['password']),
            'created_by' =>  auth()->id(),
            'updated_by' =>   auth()->id(),
        ]);

        event(new Registered($user));

        return $user;

    }
}
