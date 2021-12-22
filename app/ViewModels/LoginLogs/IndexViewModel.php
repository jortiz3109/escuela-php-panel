<?php

namespace App\ViewModels\LoginLogs;

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
        return trans('logins.titles.index');
    }

    public function filters(): array
    {
        return [];
    }

    protected function data(): array
    {
        return [
            'logins' => $this->collection,
        ];
    }
}