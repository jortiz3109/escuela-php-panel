<?php

namespace App\ViewModels\Users;

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
        return trans('users.titles.index');
    }

    protected function data(): array
    {
        return [
            'users' => $this->collection,
        ];
    }
}
