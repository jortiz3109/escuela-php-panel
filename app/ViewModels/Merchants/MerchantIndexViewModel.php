<?php

namespace App\ViewModels\Merchants;

use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\ViewModel;

class MerchantIndexViewModel extends ViewModel
{
    use HasPaginator;

    protected function buttons(): array
    {
        return [];
    }

    protected function title(): string
    {
        return trans('merchants.titles.index');
    }

    public function filters(): array
    {
        return [
            'multiple' => old('filters.multiple') ?? request()->input('filters.multiple'),
            'country' => old('filters.country') ?? request()->input('filters.country'),
            'currency' => old('filters.currency') ?? request()->input('filters.currency'),
        ];
    }

    protected function data(): array
    {
        return [
            'merchants'  => $this->collection,
        ];
    }
}
