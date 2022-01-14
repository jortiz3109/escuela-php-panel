<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\Name;
use App\Filters\Conditions\Status;
use App\Filters\Filter;
use App\Models\Currency;

class CurrencyFilters extends Filter
{
    protected string $model = Currency::class;

    protected array $applicableConditions = [
        'name' => Name::class,
        'status_enabled' => Status::class,
    ];

    protected function select(): Filter
    {
        $this->query->select(
            'currencies.id',
            'currencies.name',
            'currencies.alphabetic_code',
            'currencies.symbol',
            'currencies.enabled_at'
        );

        return $this;
    }
}
