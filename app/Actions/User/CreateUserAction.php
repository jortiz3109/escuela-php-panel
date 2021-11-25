<?php

namespace App\Actions\User;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateUserAction
{
    public static function execute(array $data): User
    {
        return User::create([
            'name' =>  $data['name'],
            'email' => $data['email'] ,
            'password' => Hash::make($data['password']),
            'created_by' =>  auth()->id(),
            'updated_by' =>   auth()->id(),
        ]);
    }
}
