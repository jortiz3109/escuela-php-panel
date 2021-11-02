<?php

namespace App\Http\Controllers;

use App\Actions\Register\CreateUser as CreateUserAction;
use App\Http\Requests\Register\UserCreateRequest;
use App\ViewModels\Users\CreateViewModel;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{

    public function create(CreateViewModel $viewModel): View
    {
        $users = auth()->user()->get();
        $viewModel->collection($users);

        return view('register.create', $viewModel->toArray());

    }

    public function store(UserCreateRequest $request)
    {
        $user = CreateUserAction::execute();

        event(new Registered($user));

        return redirect()->route('dashboard')->with('success', 'Register created successfully.');
                           
    }
}
