<?php

namespace App\ViewModels\Transactions;

use App\Http\Resources\Transactions\IndexResource;
use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\IndexViewModel;

class TransactionIndexViewModel extends IndexViewModel
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

    public function filters(): array
    {
        return [
            'status' => old('filters.status') ?? request()->input('filters.status'),
            'merchant' => old('filters.merchant') ?? request()->input('filters.merchant'),
            'reference' => old('filters.reference') ?? request()->input('filters.reference'),
            'payment_method' => old('filters.payment_method') ?? request()->input('filters.payment_method'),
            'date' => old('filters.date') ?? request()->input('filters.date'),
        ];
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
            'reference' => [
                'translation' => 'transactions.fields.reference',
                'route' => ['transactions.show', 'id'],
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
