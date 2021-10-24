<?php

namespace App\Listeners;

use App\Actions\Logins\LogSuccessfulLogin as LoginAction;
use App\Models\LoginLog;
use App\Notifications\LoggedFromUnknownDevice;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class LogSuccessfulLogin
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Login $event): void
    {
        $user = $event->user;
        $ipAddress = $this->request->ip();
        $userAgent = $this->request->server('HTTP_USER_AGENT');

        if (!LoginLog::deviceExists($ipAddress, $userAgent)) {
            try {
                $user->notify(new LoggedFromUnknownDevice());
            } catch (\Throwable $th) {
                \Illuminate\Support\Facades\Log::error($th->getMessage());
            }
        }

        LoginAction::execute([
            'user_id' => $user->id,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
        ]);
    }
}
