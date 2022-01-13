<?php

namespace App\ViewModels\Transactions;

use App\Http\Resources\Transactions\TransactionIndexResource;
use App\ViewComponents\Display\DisplayLinkComponent;
use App\ViewComponents\Display\DisplayTextComponent;
use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\IndexViewModel;

class TransactionIndexViewModel extends IndexViewModel
{
    use HasPaginator;

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
            'dates' => old('filters.dates') ?? request()->input('filters.dates'),
        ];
    }

    protected function fields(): array
    {
        return [
            'date' => DisplayTextComponent::create('transactions.fields.date')->setPositions('center'),
            'merchant' => DisplayTextComponent::create('transactions.fields.merchant'),
            'reference' => DisplayLinkComponent::create('transactions.fields.reference', 'transactions.show', 'id'),
            'currency' => DisplayTextComponent::create('transactions.fields.currency')->setPositions('center'),
            'total_amount' => DisplayTextComponent::create('transactions.fields.total_amount')->setPositions('center'),
            'payment_method' => DisplayTextComponent::create('transactions.fields.payment_method')->setPositions('center'),
            'status' => DisplayTextComponent::create('transactions.fields.status')->setPositions('center'),
        ];
    }

    protected function data(): array
    {
        return [
            'collection' => TransactionIndexResource::collection($this->collection),
        ];
    }
}
