<?php

namespace App\ViewModels\Merchants;

use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\ViewModel;
use Illuminate\Support\Facades\DB;

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
            'name'     => old('filters.name') ?? request()->input('filters.name'),
            'brand'    => old('filters.brand') ?? request()->input('filters.brand'),
            'document' => old('filters.document') ?? request()->input('filters.document'),
            'url'      => old('filters.url') ?? request()->input('filters.url'),
            'country'  => old('filters.country') ?? request()->input('filters.country'),
            'currency' => old('filters.currency') ?? request()->input('filters.currency'),
        ];
    }

    protected function data(): array
    {
        return [
            'merchants'  => $this->collection,
            'currencies' => DB::table('currencies')->select('alphabetic_code', 'name')->orderBy('alphabetic_code')->get(),
        ];
    }
}
