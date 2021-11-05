<?php

namespace App\Filters\Conditions\Merchant;

use App\Filters\Condition;
use App\Filters\Criteria;
use Illuminate\Database\Eloquent\Builder;

class Name extends Condition
{
    public static function append(Builder $query, Criteria $criteria): void
    {
        $query->where('merchants.name', 'like', "%{$criteria}%");
    }
}
