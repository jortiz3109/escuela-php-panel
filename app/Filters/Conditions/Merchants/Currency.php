<?php

namespace App\Filters\Conditions\Merchants;

use App\Filters\Condition;
use App\Filters\Criteria;
use Illuminate\Database\Eloquent\Builder;

class Currency extends Condition
{
    public static function append(Builder $query, Criteria $criteria): void
    {
        $query->where('currencies.alphabetic_code', $criteria);
    }
}
