<?php

namespace App\Filters\Conditions;

use App\Filters\Condition;
use App\Filters\Criteria;
use Illuminate\Database\Eloquent\Builder;

class EnabledAt extends Condition
{
    public static function append(Builder $query, Criteria $criteria): void
    {
        ($criteria=="1")? $query->whereNotNull('enabled_at') : $query->whereNull('enabled_at');
    }
}
