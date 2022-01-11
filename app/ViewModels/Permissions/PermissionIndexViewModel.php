<?php

namespace App\ViewModels\Permissions;

use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\IndexViewModel;

class PermissionIndexViewModel extends IndexViewModel
{
    use HasPaginator;

    protected function title(): string
    {
        return trans('permissions.titles.index');
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
            'permissions' => $this->collection,
        ];
    }
}
