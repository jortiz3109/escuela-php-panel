<?php

namespace App\ViewModels\Currencies;

use App\Http\Resources\Currencies\CurrencyIndexResource;
use App\ViewComponents\Display\DisplayEnabledComponent;
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
            'url' => DisplayEnabledComponent::create('common.status'),
        ];
    }

    public function filters(): array
    {
        return [
            'name' => old('filters.name') ?? request()->input('filters.name'),
            'status_enabled' => old('filters.status_enabled') ?? request()->input('filters.status_enabled'),
        ];
    }

    protected function data(): array
    {
        return [
            'collection' => CurrencyIndexResource::collection($this->collection),
        ];
    }
}
