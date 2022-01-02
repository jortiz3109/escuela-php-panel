<?php

namespace App\Http\Controllers;

use App\ViewModels\LoginLogs\LoginLogsIndexViewModel;
use Illuminate\View\View;

class LoginLogController extends Controller
{
    public function __invoke(LoginLogsIndexViewModel $viewModel): View
    {
        $logins = auth()->user()->logins()->with('device')->lastUserLogins()->get();

        return view('logins.index', $viewModel->collection($logins));
    }
}
