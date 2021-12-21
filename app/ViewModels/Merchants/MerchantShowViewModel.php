<?php

namespace App\ViewModels\Merchants;

use App\ViewComponents\Display\DisplayTextComponent;
use App\ViewComponents\Display\DisplayExternalURLComponent;
use App\ViewModels\ShowViewModel;

class MerchantShowViewModel extends ShowViewModel
{
    public function fields(): array
    {
        return [
            'name' => DisplayTextComponent::create('merchants.fields.name'),
            'document' => DisplayTextComponent::create('merchants.fields.document'),
            'brand' => DisplayTextComponent::create('merchants.fields.brand'),
            'country' => DisplayTextComponent::create('merchants.fields.country'),
            'currency' => DisplayTextComponent::create('merchants.fields.currency'),
            'url' => DisplayExternalURLComponent::create('merchants.fields.url'),
        ];
    }

    protected function buttons(): array
    {
        return [
            'back' => [
                'text' => trans('buttons.actions.back'),
                'route' => route('merchants.index'),
            ],
            'edit' => [
                'text' => trans('buttons.actions.edit'),
                'route' => route('merchants.edit', $this->model->getKey()),
            ],
        ];
    }
}
