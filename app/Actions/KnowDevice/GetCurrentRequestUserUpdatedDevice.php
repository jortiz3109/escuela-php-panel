<?php

namespace App\Actions\KnowDevice;

use App\Actions\KnowDevice\CreateKnowDevice;
use App\Models\KnowDevice;

class GetCurrentRequestUserUpdatedDevice
{
    public static function execute(): KnowDevice
    {
        $currentUser = auth()->user();

        $currentDevice = $currentUser
            ->knowDevices()
            ->currentDevice()
            ->first();

        if (!$currentDevice) {
            return CreateKnowDevice::execute();
        }

        $currentDevice->last_login_at = now();
        $currentDevice->save();

        return $currentDevice;
    }
}
