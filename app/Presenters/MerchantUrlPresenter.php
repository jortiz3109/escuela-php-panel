<?php

namespace App\Presenters;

class MerchantUrlPresenter extends Presenter
{
    public function show(): string
    {
        return route('merchants.show', $this->model);
    }

    public function edit(): string
    {
        return route('merchants.edit', $this->model);
    }

    public function update(): string
    {
        return route('merchants.update', $this->model);
    }
}
