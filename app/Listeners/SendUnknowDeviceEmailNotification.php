<?php

namespace App\Listeners;

use App\Notifications\LoggedFromUnknownDevice;

class SendUnknowDeviceEmailNotification
{
    public function handle($event)
    {
        $loginDeviceExistsAndIsRecent = $event->user
            ->knowDevices()
            ->currentDeviceExistsAndIsRecent();

        if (!$loginDeviceExistsAndIsRecent) {
            $event->user->notify(new LoggedFromUnknownDevice());
        }
    }
}
