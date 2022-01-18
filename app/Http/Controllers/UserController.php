<?php

namespace App\Http\Controllers;

use App\Actions\User\UserStoreAction;
use App\Actions\Users\UserUpdateAction;
use App\Events\UserStored;
use App\Http\Requests\Users\IndexRequest;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use App\ViewModels\Users\UserCreateViewModel;
use App\ViewModels\Users\UserEditViewModel;
use App\ViewModels\Users\UserIndexViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index(IndexRequest $request, UserIndexViewModel $viewModel): View
    {
        $users = User::filter($request->input('filters', []))->paginate();

        return view('modules.index', $viewModel->collection($users));
    }

    public function create(UserCreateViewModel $viewModel): View
    {
        return view('modules.create', $viewModel);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $user = UserStoreAction::execute($request->validated());

        UserStored::dispatch($user);

        return redirect(User::urlPresenter()->index())
            ->with('success', trans('users.alerts.successful_create'));
    }

    public function edit(User $user, UserEditViewModel $viewModel): View
    {
        return view('modules.edit', $viewModel->model($user));
    }

    public function update(UpdateRequest $request, User $user, UserUpdateAction $action): RedirectResponse
    {
        $action->execute($user, $request);

        return redirect(User::urlPresenter()->index())
            ->with('success', trans('users.alerts.successful_update'));
    }
}
