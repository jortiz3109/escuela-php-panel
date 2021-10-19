<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class Condition
{
    abstract public static function append(Builder $query, Criteria $criteria): void;
}
