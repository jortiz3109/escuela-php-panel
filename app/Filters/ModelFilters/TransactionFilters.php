<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\Transactions\DateBetween;
use App\Filters\Conditions\Transactions\MerchantName;
use App\Filters\Conditions\Transactions\PaymentMethodName;
use App\Filters\Conditions\Transactions\Reference;
use App\Filters\Conditions\Transactions\Status;
use App\Filters\Filter;
use App\Models\Transaction;

class TransactionFilters extends Filter
{
    protected string $model = Transaction::class;

    protected array $applicableConditions = [
        'merchant' => MerchantName::class,
        'payment_method' => PaymentMethodName::class,
        'status' => Status::class,
        'reference' => Reference::class,
        'dates' => DateBetween::class,
    ];

    protected function joins(): Filter
    {
        $this->query->join('merchants', 'transactions.merchant_id', '=', 'merchants.id');
        $this->query->join('currencies', 'transactions.currency_id', '=', 'currencies.id');
        $this->query->join('payment_methods', 'transactions.payment_method_id', '=', 'payment_methods.id');

        return $this;
    }

    protected function select(): Filter
    {
        $this->query->select(
            'transactions.id',
            'transactions.date',
            'merchants.name as merchant',
            'transactions.reference',
            'currencies.alphabetic_code as currency',
            'transactions.total_amount',
            'payment_methods.name as payment_method',
            'transactions.status',
        );

        return $this;
    }
}
