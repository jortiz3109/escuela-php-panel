<?php

namespace App\Http\Controllers;

use App\Actions\Register\CreateUser as CreateUserAction;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $userId=auth()->id();

        CreateUserAction::execute([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_by' =>  $userId,
            'updated_by' =>   $userId,
        ]);

        return redirect(RouteServiceProvider::HOME);
    }
}
