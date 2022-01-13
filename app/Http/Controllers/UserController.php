<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\IndexRequest;
use Illuminate\View\View;
use App\ViewModels\Users\UserIndexViewModel;
use App\Actions\Users\UserUpdateAction;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use App\ViewModels\Users\UserEditViewModel;

class UserController extends Controller
{
    public function index(IndexRequest $request, UserIndexViewModel $viewModel): View
    {
        $users = User::filter($request->input('filters', []))->paginate();

        return view('users.index', $viewModel->collection($users));
    }

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
