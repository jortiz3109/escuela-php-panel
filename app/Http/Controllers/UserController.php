<?php

namespace App\Http\Controllers;


use App\Http\Requests\Users\IndexRequest;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\ViewModels\Users\IndexViewModel;
use Illuminate\View\View;


class UserController extends Controller
{
    public function index(IndexRequest $request, IndexViewModel $viewModel): View
    {
        $users = User::filter($request->input('filters', []))->paginate();
        $viewModel->collection($users);

        return view('users.index', $viewModel->toArray());
    }
}
