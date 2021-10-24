<?php

namespace App\Listeners;

use App\Actions\Logins\LogSuccessfulLogin;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Http\Request;

class LogAuthenticated
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Authenticated $event): void
    {
        LogSuccessfulLogin::execute([
            'user_id' => $event->user->id,
            'ip_address' => $this->request->ip(),
            'user_agent' => $this->request->server('HTTP_USER_AGENT'),
        ]);
    }
}
