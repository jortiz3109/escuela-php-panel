<?php

namespace App\ViewModels\Transactions;

use App\Http\Resources\Transactions\IndexResource;
use App\ViewComponents\Display\DisplayLinkComponent;
use App\ViewComponents\Display\DisplayTextComponent;
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
            'date' => new DisplayTextComponent('transactions.fields.date', 'has-text-centered'),
            'merchant' => new DisplayTextComponent('transactions.fields.merchant'),
            'reference' => new DisplayLinkComponent('transactions.fields.reference', 'transactions.show', 'id'),
            'currency' => new DisplayTextComponent('transactions.fields.currency', 'has-text-centered'),
            'total_amount' => new DisplayTextComponent('transactions.fields.total_amount', 'has-text-centered'),
            'payment_method' => new DisplayTextComponent('transactions.fields.payment_method', 'has-text-centered'),
            'status' => new DisplayTextComponent('transactions.fields.status', 'has-text-centered'),
        ];
    }

    protected function data(): array
    {
        return [
            'collection' => IndexResource::collection($this->collection),
        ];
    }
}
