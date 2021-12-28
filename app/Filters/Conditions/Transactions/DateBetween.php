<?php

namespace App\Filters\Conditions\Transactions;

use App\Filters\Condition;
use App\Filters\Criteria;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class DateBetween extends Condition
{
    public static function append(Builder $query, Criteria $criteria): void
    {
        $query->whereBetween('date', [
            Carbon::parse($criteria->value()[0])->startOfDay()->toDateTimeString(),
            Carbon::parse($criteria->value()[1])->endOfDay()->toDateTimeString(),
        ]);
    }
}
