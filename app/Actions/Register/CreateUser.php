<?php

namespace App\Actions\Register;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateUser
{
    public static function execute(): User
    {
        return auth()->user()->create([
            'name' =>  request()->name ,
            'email' => request()->email ,
            'password' => Hash::make(request()->password ),
            'created_by' =>  auth()->id(),
            'updated_by' =>   auth()->id(),
        ]);

    }
}
