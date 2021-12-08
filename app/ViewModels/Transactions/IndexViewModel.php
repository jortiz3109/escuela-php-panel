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

    public function fields(): array
    {
        return [
            'date' => [
                'translation' => 'transactions.fields.date',
                'class' => 'has-text-centered',
            ],
            'merchant' => [
                'translation' => 'transactions.fields.merchant',
            ],
            'currency' => [
                'translation' => 'transactions.fields.currency',
                'class' => 'has-text-centered',
            ],
            'total_amount' => [
                'translation' => 'transactions.fields.total_amount',
                'class' => 'has-text-centered',
            ],
            'payment_method' => [
                'translation' => 'transactions.fields.payment_method',
                'class' => 'has-text-centered',
            ],
            'status' => [
                'translation' => 'transactions.fields.status',
                'class' => 'has-text-centered',
            ],
        ];
    }

    protected function data(): array
    {
        return [
            'collection' => IndexResource::collection($this->collection),
        ];
    }
}
