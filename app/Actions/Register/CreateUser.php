<?php

namespace App\Actions\Register;

use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;

class CreateUser
{
    public static function execute(): User
    {

        $user = auth()->user()->create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => Hash::make(request()->password),
            'created_by' =>  request()->id_user,
            'updated_by' =>   request()->id_user,
        ]);
        
        event(new Registered($user));

        return $user;

    }
}
