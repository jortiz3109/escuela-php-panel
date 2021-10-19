<?php

namespace App\Filters\Concerns;

use App\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

trait HasFilters
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function filter(array $conditions = []): Builder
    {
        $filter = app()->make(Filter::class, ['modelName' => get_called_class()]);
        return $filter->conditions($conditions)->apply();
    }
}
