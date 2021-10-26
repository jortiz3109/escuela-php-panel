<?php

namespace App\Listeners;

use App\Notifications\LoggedFromUnknownDevice;

class SendUnknowDeviceEmailNotification
{
    public function handle($event)
    {
        $loginDeviceExists = $event->user->logins()->deviceExists(
            request()->ip(),
            request()->userAgent()
        );

        if (!$loginDeviceExists) {
            $event->user->notify(new LoggedFromUnknownDevice());
        }
    }
}
