<?php

namespace App\Filters\Concerns;

use App\Filters\Filter;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;

trait HasFilters
{
    /**
     * @throws BindingResolutionException
     */
    public static function filter(array $conditions = []): Builder
    {
        $filter = app()->make(Filter::class, ['modelName' => get_called_class()]);
        return $filter->conditions($conditions)->apply();
    }
}
