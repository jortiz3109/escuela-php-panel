<?php

namespace App\ViewModels\LoginLogs;

use App\ViewModels\Concerns\HasCollection;
use App\ViewModels\ViewModel;

class LoginLogsIndexViewModel extends ViewModel
{
    use HasCollection;

    protected function title(): string
    {
        return trans('logins.titles.index');
    }

    protected function headers(): array
    {
        return trans('logins.fields');
    }

    protected function data(): array
    {
        return [
            'logins' => $this->collection,
        ];
    }
}
