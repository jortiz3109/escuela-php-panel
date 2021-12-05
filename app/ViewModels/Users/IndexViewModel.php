<?php

namespace App\ViewModels\Users;

use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\ViewModel;

class IndexViewModel extends ViewModel
{
    use HasPaginator;

    protected function buttons(): array
    {
        return [];
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
            'status' => old('filters.status') ?? request()->input('filters.status'),
        ];
    }
    protected function data(): array
    {
        return [
            'users' => $this->collection,
        ];
    }
}
