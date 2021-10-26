<?php

namespace App\Actions\Logins;

use App\Actions\KnowDevice\GetCurrentRequestUserUpdatedDevice;
use App\Models\LoginLog;

class LogSuccessfulLogin
{
    public static function execute(): void
    {
        $login = new LoginLog();

        $loginDevice = GetCurrentRequestUserUpdatedDevice::execute();

        $login->user_id = auth()->id();
        $login->device_id = $loginDevice->id;
        $login->ip_address = request()->ip();

        $login->save();
    }
}
