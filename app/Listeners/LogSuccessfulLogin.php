<?php

namespace App\Listeners;

use App\Actions\Logins\LogSuccessfulLogin as LogSuccessfulLoginAction;

class LogSuccessfulLogin
{
    public function handle(): void
    {
        LogSuccessfulLoginAction::execute();
    }
}
