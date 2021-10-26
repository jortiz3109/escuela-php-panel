<?php

namespace App\Http\Controllers;

class LoginLogController extends Controller
{
    public function __invoke()
    {
        $logins = auth()->user()->logins()->lastUserLogins()->get();

        return view('logins.index', [
            'logins' => $logins,
            'texts' => [
                'title' => __('logins.titles.index'),
            ],
            'buttons' => [],
        ]);
    }
}
