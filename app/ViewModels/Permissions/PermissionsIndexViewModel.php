<?php

namespace App\ViewModels\Permissions;

use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\ViewModel;

class PermissionsIndexViewModel extends ViewModel
{
    use HasPaginator;

    protected function title(): string
    {
        return trans('permissions.titles.index');
    }

    protected function filters(): array
    {
        return [
            'name' => old('filters.name') ?? request()->input('filters.name'),
        ];
    }

    protected function headers(): array
    {
        return trans('permissions.fields');
    }

    protected function data(): array
    {
        return [
            'permissions' => $this->collection,
        ];
    }
}
