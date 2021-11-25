<?php

namespace App\Actions\User;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateUserAction
{
    public static function execute(array $data): User
    {
        return User::create([
            'name' =>  $user['name'],
            'email' => $user['email'] ,
            'password' => Hash::make($user['password']),
            'created_by' =>  auth()->id(),
            'updated_by' =>   auth()->id(),
        ]);
    }
}
