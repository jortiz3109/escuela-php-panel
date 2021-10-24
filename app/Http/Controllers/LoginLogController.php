<?php

namespace App\Http\Controllers;

use App\Models\LoginLog;

class LoginLogController extends Controller
{
    public function __invoke()
    {
        $logins = LoginLog::lastUserLogins()->get();

        return view('logins.index', [
            'logins' => $logins,
            'texts' => [
                'title' => __('logins.titles.index'),
            ],
            'buttons' => [],
        ]);
    }
}
