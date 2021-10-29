<?php

namespace App\Http\Controllers;

use App\Actions\Register\CreateUser as CreateUserAction;
use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Requests\Register\UserCreateRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\View\View;

class UserController extends Controller
{

    public function create()
    {
        $userId=auth()->id();
        return view('register.create', [
            "buttons" => [],
            "texts"=>[
                "title" => "Register User",
                "userId" => $userId
            ],
            "filters" => [],
        ]);
    }

    public function store(UserCreateRequest $request)
    {
        CreateUserAction::execute($request->validated());

        return view('dashboard', [
            'texts' => [
                'title' => 'Register created successfully.',
            ],
            'buttons' => [],
            'filters' => [],
        ]);
                 
                    
    }
}
