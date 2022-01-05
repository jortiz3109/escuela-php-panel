<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\ViewModels\Users\UserEditViewModel;

class UserController extends Controller
{
    public function edit(User $user, UserEditViewModel $viewModel)
    {
        return view('modules.edit', $viewModel->model($user));
    }
}
