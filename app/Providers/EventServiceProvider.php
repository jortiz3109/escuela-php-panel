<?php

namespace App\Providers;

use App\Listeners\LogSuccessfulLogin;
use App\Listeners\SendUnknowDeviceEmailNotification;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        Login::class => [
            SendUnknowDeviceEmailNotification::class,
            LogSuccessfulLogin::class,
        ],
    ];
}
