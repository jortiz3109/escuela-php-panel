<?php

namespace App\ViewModels\Merchants;

use App\Http\Resources\Merchants\MerchantShowResource;
use App\Models\Merchant;
use App\ViewComponents\Display\DisplayExternalURLComponent;
use App\ViewComponents\Display\DisplayTextComponent;
use App\ViewModels\Concerns\HasModel;
use App\ViewModels\ViewModel;

class MerchantShowViewModel extends ViewModel
{
    use HasModel;

    protected function title(): string
    {
        return $this->model->name;
    }

    protected function data(): array
    {
        return [
            'model' => (new MerchantShowResource($this->model))->toArray(),
        ];
    }

    protected function fields(): array
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
                'route' => Merchant::urlPresenter()->edit($this->model),
            ],
        ];
    }
}
