<?php

namespace App\Filters\Conditions\Transactions;

use App\Filters\Condition;
use App\Filters\Criteria;
use Illuminate\Database\Eloquent\Builder;

class MerchantName extends Condition
{
    public static function append(Builder $query, Criteria $criteria): void
    {
        $query->where('merchants.name', 'like', "%{$criteria}%");
    }
}
