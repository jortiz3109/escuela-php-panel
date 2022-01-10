<?php

namespace App\Actions\Users;

use App\Actions\ActionContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserUpdateAction implements ActionContract
{
    public function execute(Model $user, Request $request): Model
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return $user;
    }
}
