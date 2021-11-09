<?php

namespace App\Actions\KnowDevice;

use App\Models\KnowDevice;

class CreateKnowDevice
{
    public static function execute(): KnowDevice
    {
        return auth()->user()->knowDevices()->create([
            'user_agent' => request()->userAgent(),
            'last_login_at' => now(),
        ]);
    }
}
