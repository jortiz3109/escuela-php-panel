<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Laravel\Fortify\Http\Controllers\VerifyEmailController as VerifyEmailControllerFortify;
use Symfony\Component\HttpFoundation\RedirectResponse;

class VerifyEmailController extends VerifyEmailControllerFortify
{
    public function verifies(Request $request): RedirectResponse
    {
        $user = User::find($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(config('fortify.home') . '?verified=1');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect('login')->with('status', trans('users.messages.email_verified_success'));
    }
}
