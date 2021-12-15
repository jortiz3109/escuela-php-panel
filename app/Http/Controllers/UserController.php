<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\ViewModels\Users\ShowViewModel;
use Illuminate\View\View;

class UserController extends Controller
{
    public function show(User $user, ShowViewModel $viewModel): View
    {
        $viewModel->model($user);

        return view('layouts.show', $viewModel);
    }
}
