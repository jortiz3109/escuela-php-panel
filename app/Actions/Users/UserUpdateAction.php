<?php

namespace App\Actions\Users;

use App\Actions\ActionContract;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserUpdateAction implements ActionContract
{
    public function execute(Model $user, Request $request): Model
    {
        $this->emailRevalidation($user, $request);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return $user;
    }

    public function emailRevalidation(User $user, Request $request): void
    {
        if ($user->email !== $request->input('email')) {
            $user->disableEmailVerification();
        }
    }
}
