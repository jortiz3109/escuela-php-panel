<?php

namespace App\Http\Controllers;

use App\Actions\Register\CreateUser as CreateUserAction;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Http\Requests\Register\UserCreateRequest;
use Illuminate\View\View;

class UserController extends Controller
{

    public function create(): View
    {
        $userId = auth()->id();
        return view('register.create', [
            "buttons" => [],
            "texts"=> [
                "title" => "Register User",
            ],
            "filters" => [],
        ]);
    }

    public function store(UserCreateRequest $request): View
    {
        $user = CreateUserAction::execute();

        event(new Registered($user));

        return view('dashboard', [
            'texts' => [
                'title' => 'Register created successfully.',
            ],
            'buttons' => [],
            'filters' => [],
        ]);
                           
    }
}
