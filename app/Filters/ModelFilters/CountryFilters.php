<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\Name;
use App\Filters\Conditions\Status;
use App\Filters\Filter;
use App\Models\Country;

class CountryFilters extends Filter
{
    protected string $model = Country::class;

    protected array $applicableConditions = [
        'name' => Name::class,
        'status_enabled' => Status::class,
    ];

    protected function select(): Filter
    {
        $this->query->select(
            'countries.id',
            'countries.name',
            'countries.alpha_two_code',
            'countries.enabled_at'
        );

        return $this;
    }
}
