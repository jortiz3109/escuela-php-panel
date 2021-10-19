<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\Name;
use App\Filters\Filter;
use App\Models\Permission;

class PermissionFilters extends Filter
{
    protected string $model = Permission::class;
    protected array $applicableConditions = [
        'name' => Name::class,
    ];
}
