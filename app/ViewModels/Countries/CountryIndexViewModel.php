<?php

namespace App\ViewModels\Countries;

use App\ViewComponents\Display\DisplayTextComponent;
use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\IndexViewModel;

class CountryIndexViewModel extends IndexViewModel
{
    use HasPaginator;

    protected function title(): string
    {
        return trans('countries.titles.index');
    }

    protected function fields(): array
    {
        return [
            'name' => DisplayTextComponent::create('countries.fields.name'),
            'alpha_two_code' => DisplayTextComponent::create('countries.fields.alpha_two_code'),
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
