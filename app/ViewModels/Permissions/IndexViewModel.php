<?php

namespace App\ViewModels\Permissions;

use App\ViewModels\Concerns\HasCollection;
use App\ViewModels\ViewModel;

class IndexViewModel extends ViewModel
{
    use HasCollection;

    protected function buttons(): array
    {
        return [];
    }

    protected function title(): string
    {
        return trans('permissions.titles.index');
    }

    protected function data(): array
    {
        return [
            'permissions' => $this->collection,
        ];
    }
}
