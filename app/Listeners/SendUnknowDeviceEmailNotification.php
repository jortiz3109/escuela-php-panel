<?php

namespace App\Listeners;

use App\Notifications\LoggedFromUnknownDevice;

class SendUnknowDeviceEmailNotification
{
    public function handle($event)
    {
        $loginDeviceExists = $event->user
            ->knowDevices()
            ->currentDeviceExists();

        if (!$loginDeviceExists) {
            $event->user->notify(new LoggedFromUnknownDevice());
        }
    }
}
