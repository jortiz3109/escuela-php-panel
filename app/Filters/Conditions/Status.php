<?php

namespace App\Filters\Conditions;

use App\Filters\Condition;
use App\Filters\Criteria;
use Illuminate\Database\Eloquent\Builder;

class Status extends Condition
{
    public static function append(Builder $query, Criteria $criteria): void
    {
        $query->when($criteria == 'enabled', function ($q) {
            $q->whereNotNull('enabled_at');
        })->when($criteria == 'disabled', function ($q) {
            $q->whereNull('enabled_at');
        });
    }
}
