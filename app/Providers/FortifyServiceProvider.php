<?php

namespace App\Providers;

use App\Actions\Auth\DisableUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return
                Limit::perMinute(config('auth.max_attempts'))
                    ->by($request->email . $request->ip())
                    ->response(function () use ($request) {
                        DisableUser::execute($request->email);
                    });
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();
    
            if (
                $user
                && Hash::check($request->password, $user->password)
                && $user->isEnabled()
            ) {
                return $user;
            }

            throw ValidationException::withMessages([
                Fortify::username() => [trans('auth.blocked')],
            ]);
        });
    }
}
