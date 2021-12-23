<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\Transactions\Date;
use App\Filters\Conditions\Transactions\Merchant;
use App\Filters\Conditions\Transactions\PaymentMethod;
use App\Filters\Conditions\Transactions\Reference;
use App\Filters\Conditions\Transactions\Status;
use App\Filters\Filter;
use App\Models\Transaction;

class TransactionFilters extends Filter
{
    protected string $model = Transaction::class;

    protected array $applicableConditions = [
        'merchant' => Merchant::class,
        'payment_method' => PaymentMethod::class,
        'status' => Status::class,
        'reference' => Reference::class,
        'date' => Date::class,
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
            'transactions.executed_at',
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
