<?php

namespace App\ViewModels\Merchants;

use App\ViewComponents\Display\Buttons\DisplayEditButton;
use App\ViewComponents\Display\Buttons\DisplayShowButton;
use App\ViewComponents\Display\DisplayButtonGroup;
use App\ViewComponents\Display\DisplayTextComponent;
use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\IndexViewModel;

class MerchantIndexViewModel extends IndexViewModel
{
    use HasPaginator;

    protected function buttons(): array
    {
        return [
            'create' => [
                'text' => trans('merchants.titles.create'),
                'route' => route('merchants.create'),
            ],
        ];
    }

    protected function title(): string
    {
        return trans('merchants.titles.index');
    }

    public function filters(): array
    {
        return [
            'merchant_query' => old('filters.merchant_query') ?? request()->input('filters.merchant_query'),
            'country' => old('filters.country') ?? request()->input('filters.country'),
            'currency' => old('filters.currency') ?? request()->input('filters.currency'),
        ];
    }

    protected function fields(): array
    {
        return [
            'name' => DisplayTextComponent::create('merchants.fields.name'),
            'document' => DisplayTextComponent::create('merchants.fields.document'),
            'url' => DisplayTextComponent::create('merchants.fields.url')->setPositions('center'),
            'country' => DisplayTextComponent::create('merchants.fields.country'),
            'currency' => DisplayTextComponent::create('merchants.fields.currency'),
            'button_group' => DisplayButtonGroup::create([
                DisplayShowButton::create('merchants.show'),
                DisplayEditButton::create('merchants.edit'),
            ])->setValuePosition('center'),
        ];
    }

    protected function data(): array
    {
        return [
            'collection' => $this->collection,
        ];
    }
}
