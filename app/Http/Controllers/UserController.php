<?php

namespace App\Http\Controllers;

use App\Actions\Users\UserUpdateAction;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use App\ViewModels\Users\UserEditViewModel;

class UserController extends Controller
{
    public function edit(User $user, UserEditViewModel $viewModel)
    {
        return view('modules.edit', $viewModel->model($user));
    }

    // TODO: Change permissions.index with users.index when EP-8 merge
    public function update(UpdateRequest $request, User $user, UserUpdateAction $action)
    {
        $action->execute($user, $request);

        return redirect()
            ->route('permissions.index')
            ->with('success', trans('users.alerts.successful_update'));
    }
}
