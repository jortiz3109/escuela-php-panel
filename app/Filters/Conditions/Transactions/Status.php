<?php

namespace App\Filters\Conditions\Transactions;

use App\Filters\Condition;
use App\Filters\Criteria;
use Illuminate\Database\Eloquent\Builder;

class Status extends Condition
{
    public static function append(Builder $query, Criteria $criteria): void
    {
        $query->where('status', $criteria);
    }
}
