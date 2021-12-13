<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\ViewModels\ShowViewModel;
use Illuminate\View\View;

class UserController extends Controller
{
    public function show(User $user, ShowViewModel $viewModel): View
    {
        $viewModel->show($user);

        return view('layouts.show', $viewModel->toArray());
    }
}
