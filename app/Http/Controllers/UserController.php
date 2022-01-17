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
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Client\Request;
use Illuminate\Http\RedirectResponse;
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

        return redirect()->route('users.index')->with('success', trans('users.message.success'));
    }

    public function index(IndexRequest $request, UserIndexViewModel $viewModel): View
    {
        $users = User::filter($request->input('filters', []))->paginate();

        return view('users.index', $viewModel->collection($users));
    }

    public function edit(User $user, UserEditViewModel $viewModel): View
    {
        return view('modules.edit', $viewModel->model($user));
    }

    public function update(UpdateRequest $request, User $user, UserUpdateAction $action): RedirectResponse
    {
        $action->execute($user, $request);

        return redirect()
            ->route('users.index')
            ->with('success', trans('users.alerts.successful_update'));
    }

    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));

        if (!hash_equals((string)$request->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException();
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }
}
