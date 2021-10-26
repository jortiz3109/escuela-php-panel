<?php

namespace App\Http\Controllers;

use App\Actions\Register\CreateUser as CreateUserAction;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Register\UserCreateRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\View\View;

class UserController extends Controller
{

    public function create()
    {

        return view('register.create', [
            "buttons" => [],
            "texts"=>[
                "title" => "Register User"
            ]
        ]);
    }

    public function store(UserCreateRequest $request)
    {
        $userId=auth()->id();

       $response= CreateUserAction::execute([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_by' =>  $userId,
            'updated_by' =>   $userId,
        ]);

        return $response;
    }
}
