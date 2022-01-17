<?php

namespace App\Listeners;

use App\Events\UserStored;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;

class SendUserEmailVerification
{
    public function handle(UserStored $event): void
    {
        $event->user()->save() ?
            event(new Registered($event->user())) :
            Log::error(trans('users.log.email_validation_could_not_be_sent', ['email' => $event->user->email, 'id' => $event->user->email]));
    }
}
