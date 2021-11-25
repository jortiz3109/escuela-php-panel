<?php

namespace App\ViewModels\Users;

use App\ViewModels\Concerns\HasCollection;
use App\ViewModels\ViewModel;

class CreateViewModel extends ViewModel
{
    use HasCollection;

    protected function buttons(): array
    {
        return [];
    }

    protected function title(): string
    {
        return trans('users.titles.create');
    }

    public function filters(): array
    {
        return [];
    }

    protected function data(): array
    {
        return [
           
        ];
    }
}
