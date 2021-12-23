<?php

namespace App\Filters\Conditions\Transactions;

use App\Filters\Condition;
use App\Filters\Criteria;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class Date extends Condition
{
    public static function append(Builder $query, Criteria $criteria): void
    {
        if ($dates = $criteria->value()) {
            $query->whereBetween('executed_at', [
                Carbon::parse($dates[0])->toDateString() . ' 00:00:00',
                Carbon::parse($dates[1])->toDateString() . ' 23:59:59',
            ]);
        }
    }
}
