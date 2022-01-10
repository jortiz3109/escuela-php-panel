<?php

namespace App\ViewModels\Transactions;

use App\Http\Resources\Transactions\TransactionShowResource;
use App\ViewComponents\Display\DisplayCurrencyComponent;
use App\ViewComponents\Display\DisplayImageComponent;
use App\ViewComponents\Display\DisplayMapComponent;
use App\ViewComponents\Display\DisplayTextComponent;
use App\ViewModels\Concerns\HasModel;
use App\ViewModels\ViewModel;

class TransactionDetailsViewModel extends ViewModel
{
    use HasModel;

    protected function fields(): array
    {
        return [
            'transactions.titles.data' => [
                'merchant' => DisplayTextComponent::create('transactions.fields.merchant'),
                'reference' => DisplayTextComponent::create('transactions.fields.reference'),
                'payment_method' => DisplayImageComponent::create('transactions.fields.payment_method'),
                'card_number' => DisplayTextComponent::create('transactions.fields.card_number'),
                'currency' => DisplayCurrencyComponent::create('transactions.fields.currency'),
                'total_amount' => DisplayTextComponent::create('transactions.fields.total_amount'),
                'status' => DisplayTextComponent::create('transactions.fields.status'),
                'ip_address' => DisplayTextComponent::create('transactions.fields.total_amount'),
                'executed_at' => DisplayTextComponent::create('transactions.fields.executed'),
            ],
            'transactions.fields.geolocation' => [
                'geolocation' => DisplayMapComponent::create('transactions.fields.geolocation'),
            ],
            'transactions.titles.payer' => [
                'payer_name' => DisplayTextComponent::create('common.fields.name'),
                'payer_email' => DisplayTextComponent::create('common.fields.email'),
            ],
            'transactions.titles.buyer' => [
                'buyer_name' => DisplayTextComponent::create('common.fields.name'),
                'buyer_email' => DisplayTextComponent::create('common.fields.email'),
            ],
        ];
    }

    protected function buttons(): array
    {
        return [
            'back' => [
                'text' => trans('buttons.actions.back'),
                'route' => route('transactions.index'),
            ],
        ];
    }

    protected function title(): string
    {
        return trans('transactions.titles.details');
    }

    protected function data(): array
    {
        return [
            'model'  => (new TransactionShowResource($this->model))->toArray(),
        ];
    }
}
