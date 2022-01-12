<?php

namespace App\ViewModels\PaymentMethods;

use App\Http\Resources\PaymentMethods\PaymentMethodIndexResource;
use App\ViewComponents\Display\DisplayEnabledComponent;
use App\ViewComponents\Display\DisplayLogoComponent;
use App\ViewComponents\Display\DisplayTextComponent;
use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\IndexViewModel;

class PaymentMethodsIndexViewModel extends IndexViewModel
{
    use HasPaginator;

    protected function buttons(): array
    {
        return [];
    }

    protected function title(): string
    {
        return trans('users.titles.index');
    }

    public function filters(): array
    {
        return [
            'name' => old('filters.name') ?? request()->input('filters.name'),
            'enabled_at' => old('filters.enabled') ?? request()->input('filters.enabled'),
        ];
    }

    protected function fields(): array
    {
        return [
            'name' => DisplayTextComponent::create('merchants.fields.name'),
            'logo' => DisplayLogoComponent::create('common.logo'),
            'url' => DisplayEnabledComponent::create('common.status'),
        ];
    }

    protected function data(): array
    {
        return [
            'collection' => PaymentMethodIndexResource::collection($this->collection),
        ];
    }
}
