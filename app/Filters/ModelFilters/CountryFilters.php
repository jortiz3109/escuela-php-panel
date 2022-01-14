<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\Name;
use App\Filters\Filter;
use App\Models\Country;

class CountryFilters extends Filter
{
    protected string $model = Country::class;

    protected array $applicableConditions = [
        'name' => Name::class,
    ];

    protected function select(): Filter
    {
        $this->query->select(['name', 'alpha_two_code']);
        return $this;
    }
}
