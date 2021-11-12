<?php

namespace App\Filters\Conditions\Countries;

use App\Filters\Condition;
use App\Filters\Criteria;
use Illuminate\Database\Eloquent\Builder;

class TwoCode extends Condition
{
    public static function append(Builder $query, Criteria $criteria): void
    {
        $query->where('countries.alpha_two_code', $criteria);
    }
}
