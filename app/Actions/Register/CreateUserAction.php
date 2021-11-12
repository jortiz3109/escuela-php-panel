<?php

namespace App\Actions\Register;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateUserAction
{
    public static function execute(array $user): User
    {
        return auth()->user()->create([
            'name' =>  $user['name'],
            'email' => $user['email'] ,
            'password' => Hash::make($user['password']),
            'created_by' =>  auth()->id(),
            'updated_by' =>   auth()->id(),
        ]);

    }
}
