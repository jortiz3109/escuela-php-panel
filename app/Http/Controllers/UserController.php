<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\IndexRequest;
use App\Models\User;
use App\ViewModels\Users\UserIndexViewModel;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(IndexRequest $request, UserIndexViewModel $viewModel): View
    {
        $users = User::filter($request->input('filters', []))->paginate();

        return view('users.index', $viewModel->collection($users));
    }
}
