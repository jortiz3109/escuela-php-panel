<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\Name;
use App\Filters\Filter;
use App\Models\Currency;

class CurrencyFilters extends Filter
{
    protected string $model = Currency::class;

    protected array $applicableConditions = [
        'name' => Name::class,
    ];

    protected function select(): Filter
    {
        $this->query->select(['name', 'alphabetic_code', 'symbol']);
        return $this;
    }
}
