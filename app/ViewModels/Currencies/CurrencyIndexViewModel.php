<?php

namespace App\ViewModels\Currencies;

use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\IndexViewModel;

class CurrencyIndexViewModel extends IndexViewModel
{
    use HasPaginator;

    protected function buttons(): array
    {
        return [];
    }

    protected function title(): string
    {
        return trans('currencies.titles.index');
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
            'currencies' => $this->collection,
        ];
    }
}
