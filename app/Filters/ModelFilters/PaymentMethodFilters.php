<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\Name;
use App\Filters\Conditions\Status;
use App\Filters\Filter;
use App\Models\PaymentMethod;

class PaymentMethodFilters extends Filter
{
    protected string $model = PaymentMethod::class;

    protected array $applicableConditions = [
        'name' => Name::class,
        'status' => Status::class,
    ];

    protected function select(): Filter
    {
        $this->query->select(
            'payment_methods.id',
            'payment_methods.name',
            'payment_methods.logo',
            'payment_methods.enabled_at',
        );

        return $this;
    }
}
