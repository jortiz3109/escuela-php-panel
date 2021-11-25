<?php

namespace App\Http\Controllers;

use App\Actions\User\CreateUserAction;
use App\Http\Requests\Register\UserCreateRequest;
use App\ViewModels\Users\CreateViewModel;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{

    public function create(CreateViewModel $viewModel): View
    {
        return view('register.create', $viewModel->toArray());
    }

    public function store(UserCreateRequest $request)
    {
        $user = CreateUserAction::execute($request->validated());

        event(new Registered($user));

        return redirect()->route('dashboard')->with('success', 'Register created successfully.');
                           
    }
}
