<?php

namespace App\Http\Controllers;

use App\Actions\User\UserStoreAction;
use App\Events\UserStored;
use App\Http\Requests\Users\UserCreateRequest;
use App\ViewModels\Users\UserCreateViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function create(UserCreateViewModel $viewModel): View
    {
        return view('modules.create', $viewModel);
    }

    public function store(UserCreateRequest $request): RedirectResponse
    {
        $user = UserStoreAction::execute($request->validated());

        UserStored::dispatch($user);

        return redirect()->route('dashboard')->with('success', trans('users.message.success'));
    }
}
