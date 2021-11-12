<?php

namespace App\Filters\Conditions\Merchants;

use App\Filters\Condition;
use App\Filters\Criteria;
use Illuminate\Database\Eloquent\Builder;

class Multiple extends Condition
{
    public static function append(Builder $query, Criteria $criteria): void
    {
        $query->where(function ($q) use ($criteria) {
            $q->where('merchants.name', 'like', "%{$criteria}%")
                ->orWhere('merchants.brand', 'like', "%{$criteria}%")
                ->orWhere('merchants.document', 'like', "%{$criteria}%");
        });
    }
}
