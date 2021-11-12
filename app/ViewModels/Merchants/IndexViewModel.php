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
            'multiple' => old('filters.multiple') ?? request()->input('filters.multiple'),
            'country' => old('filters.country') ?? request()->input('filters.country'),
        ];
    }

    protected function data(): array
    {
        return [
            'merchants'  => $this->collection,
            'countries' => DB::table('countries')->select('name', 'alpha_two_code')->orderBy('name')->get(),
        ];
    }
}
