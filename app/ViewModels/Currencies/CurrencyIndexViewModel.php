<?php

namespace App\ViewModels\Currencies;

use App\ViewComponents\Display\DisplayTextComponent;
use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\IndexViewModel;

class CurrencyIndexViewModel extends IndexViewModel
{
    use HasPaginator;

    protected function title(): string
    {
        return trans('currencies.titles.index');
    }

    protected function fields(): array
    {
        return [
            'name' => DisplayTextComponent::create('currencies.fields.name'),
            'alphabetic_code' => DisplayTextComponent::create('currencies.fields.alphabetic_code'),
            'symbol' => DisplayTextComponent::create('currencies.fields.symbol'),
        ];
    }

    public function filters(): array
    {
        return [
            'name' => old('filters.name') ?? request()->input('filters.name'),
        ];
    }

    protected function data(): array
    {
        return [
            'collection' => $this->collection,
        ];
    }
}
