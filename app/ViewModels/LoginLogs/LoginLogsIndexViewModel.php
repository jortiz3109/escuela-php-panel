<?php

namespace App\ViewModels\LoginLogs;

use App\ViewModels\Concerns\HasCollection;
use App\ViewModels\IndexViewModel;

class LoginLogsIndexViewModel extends IndexViewModel
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
