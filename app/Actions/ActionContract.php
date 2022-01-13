<?php

namespace App\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface ActionContract
{
    public function execute(Model $model, Request $request): Model;
}
