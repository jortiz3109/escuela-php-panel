<?php

namespace App\Presenters;

use Illuminate\Database\Eloquent\Model;

abstract class Presenter
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    abstract public function show(): string;

    abstract public function edit(): string;

    abstract public function update(): string;
}
