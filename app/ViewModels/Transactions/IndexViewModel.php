<?php

namespace App\ViewModels\Transactions;

use App\Http\Resources\Transactions\IndexResource;
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
        return trans('transactions.titles.index');
    }

    protected function data(): array
    {
        return [
            'collection' => IndexResource::collection($this->collection),
        ];
    }
}
