<?php

namespace App\Presenters;

use Illuminate\Database\Eloquent\Model;

class Presenter
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
