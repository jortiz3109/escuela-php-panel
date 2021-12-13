<?php

namespace App\Http\Controllers;

use App\Actions\User\UserStoreAction;
use App\Http\Requests\Users\UserCreateRequest;
use App\Models\User;
use App\ViewModels\Users\CreateViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function create(CreateViewModel $viewModel): View
    {
        return view('users.create', $viewModel->toArray());
    }

    public function store(UserCreateRequest $request): RedirectResponse
    {
        UserStoreAction::execute($request->validated(), new User());
        return redirect()->route('dashboard')->with('success', trans('users.message.success'));
    }
}
