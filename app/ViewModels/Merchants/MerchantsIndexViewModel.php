<?php

namespace App\ViewModels\Merchants;

use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\ViewModel;

class MerchantsIndexViewModel extends ViewModel
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

    protected function headers(): array
    {
        return array_merge(trans('merchants.fields'), parent::headers());
    }

    protected function filters(): array
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
