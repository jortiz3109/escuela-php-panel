<?php

namespace App\Http\Controllers;

use App\Actions\User\UserStoreAction;
use App\Actions\Users\UserUpdateAction;
use App\Events\UserStored;
use App\Http\Requests\Users\IndexRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Http\Requests\Users\UserCreateRequest;
use App\Models\User;
use App\ViewModels\Users\UserCreateViewModel;
use App\ViewModels\Users\UserEditViewModel;
use App\ViewModels\Users\UserIndexViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    private const USER_INDEX_ROUTE = 'users.index';

    public function create(UserCreateViewModel $viewModel): View
    {
        return view('modules.create', $viewModel);
    }

    public function store(UserCreateRequest $request): RedirectResponse
    {
        $user = UserStoreAction::execute($request->validated());

        UserStored::dispatch($user);

        return redirect()->route(self::USER_INDEX_ROUTE)->with('success', trans('users.message.success'));
    }

    public function index(IndexRequest $request, UserIndexViewModel $viewModel): View
    {
        $users = User::filter($request->input('filters', []))->paginate();

        return view(self::USER_INDEX_ROUTE, $viewModel->collection($users));
    }

    public function edit(User $user, UserEditViewModel $viewModel): View
    {
        return view('modules.edit', $viewModel->model($user));
    }

    public function update(UpdateRequest $request, User $user, UserUpdateAction $action): RedirectResponse
    {
        $action->execute($user, $request);

        return redirect()
            ->route(self::USER_INDEX_ROUTE)
            ->with('success', trans('users.alerts.successful_update'));
    }
}
