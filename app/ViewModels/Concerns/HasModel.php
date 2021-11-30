<?php

namespace App\ViewModels\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasModel
{
    protected Model $model;

    public function model(Model $model): self
    {
        $this->model = $model;

        return $this;
    }
}
