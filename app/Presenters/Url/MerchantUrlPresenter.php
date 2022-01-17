<?php

namespace App\Presenters\Url;

use App\Models\Merchant;

class MerchantUrlPresenter extends UrlPresenter
{
    public function index(string $filters = ''): string
    {
        return route('merchants.index', $filters);
    }

    public function store(): string
    {
        return route('merchants.store');
    }

    public function create(): string
    {
        return route('merchants.create');
    }

    public function show(Merchant $merchant): string
    {
        return route('merchants.show', $merchant);
    }

    public function edit(Merchant $merchant): string
    {
        return route('merchants.edit', $merchant);
    }

    public function update(Merchant $merchant): string
    {
        return route('merchants.update', $merchant);
    }
}
