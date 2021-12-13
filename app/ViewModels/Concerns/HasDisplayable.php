<?php

namespace App\ViewModels\Concerns;

use App\PropsViews\Contracts\ShowPropsViews;

trait HasDisplayable
{
    protected ShowPropsViews $model;

    public function show(ShowPropsViews $model): self
    {
        $this->model = $model;

        return $this;
    }
}
