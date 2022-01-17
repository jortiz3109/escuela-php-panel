<?php

namespace App\ViewModels\Users;

use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\IndexViewModel;

class UserIndexViewModel extends IndexViewModel
{
    use HasPaginator;

    protected function buttons(): array
    {
        return [
            'create' => [
                'text' => trans('users.buttons.save'),
                'route' => route('users.create'),
            ],
        ];
    }

    protected function title(): string
    {
        return trans('users.titles.index');
    }

    public function filters(): array
    {
        return [
            'email' => old('filters.email') ?? request()->input('filters.email'),
            'created_at' => old('filters.created_at') ?? request()->input('filters.created_at'),
            'status_enabled' => old('filters.status') ?? request()->input('filters.status_enabled'),
        ];
    }

    protected function data(): array
    {
        return [
            'users' => $this->collection,
        ];
    }
}
