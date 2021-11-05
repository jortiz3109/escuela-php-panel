<?php

namespace App\ViewModels\Merchants;

use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\ViewModel;

class IndexViewModel extends ViewModel
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
            'name' => old('filters.name') ?? request()->input('filters.name'),
            'brand' => old('filters.brand') ?? request()->input('filters.brand'),
            'document' => old('filters.document') ?? request()->input('filters.document'),
            'url' => old('filters.url') ?? request()->input('filters.url'),
        ];
    }

    protected function data(): array
    {
        return [
            'merchants' => $this->collection,
        ];
    }
}
