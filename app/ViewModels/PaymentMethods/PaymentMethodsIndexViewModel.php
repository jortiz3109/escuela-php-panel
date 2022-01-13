<?php

namespace App\ViewModels\PaymentMethods;

use App\Http\Resources\PaymentMethods\PaymentMethodIndexResource;
use App\ViewComponents\Display\DisplayEnabledComponent;
use App\ViewComponents\Display\DisplayImageComponent;
use App\ViewComponents\Display\DisplayTextComponent;
use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\IndexViewModel;

class PaymentMethodsIndexViewModel extends IndexViewModel
{
    use HasPaginator;

    protected function buttons(): array
    {
        return [
            'back' => [
                'text' => trans('buttons.actions.back'),
                'route' => route('dashboard'),
            ],
        ];
    }

    protected function title(): string
    {
        return trans('common.payment_methods');
    }

    public function filters(): array
    {
        return [
            'name' => old('filters.name') ?? request()->input('filters.name'),
            'status_enabled' => old('filters.status_enabled') ?? request()->input('filters.status_enabled'),
        ];
    }

    protected function fields(): array
    {
        return [
            'name' => DisplayTextComponent::create('merchants.fields.name'),
            'logo' => DisplayImageComponent::create('common.logo'),
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
