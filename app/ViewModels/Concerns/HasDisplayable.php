<?php

namespace App\ViewModels\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasDisplayable
{
    protected Model $model;

    public function show(Model $model): self
    {
        $this->model = $model;

        return $this;
    }
}
