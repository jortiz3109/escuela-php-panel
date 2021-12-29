<?php

namespace App\Actions\Permissions;

use App\Actions\ActionContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PermissionUpdateAction implements ActionContract
{
    public function execute(Model $permission, Request $request): Model
    {
        $permission->name = $request->input('name');
        $permission->description = $request->input('description');
        $permission->save();

        return $permission;
    }
}
