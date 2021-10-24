<?php

namespace App\Actions\Logins;

use App\Models\LoginLog;

class LogSuccessfulLogin
{
    public static function execute(array $payload): void
    {
        $login = new LoginLog();

        $login->user_id = $payload['user_id'];
        $login->ip_address = $payload['ip_address'];
        $login->user_agent = $payload['user_agent'];

        $login->save();
    }
}
