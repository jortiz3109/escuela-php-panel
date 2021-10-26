<?php

namespace App\Http\Controllers;

use App\ViewModels\LoginLogs\IndexViewModel;

class LoginLogController extends Controller
{
    public function __invoke(IndexViewModel $viewModel)
    {
        $logins = auth()->user()->logins()->with('device')->lastUserLogins()->get();
        $viewModel->collection($logins);

        return view('logins.index', $viewModel->toArray());
    }
}
