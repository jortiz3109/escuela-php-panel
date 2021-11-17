<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\CreatedAt;
use App\Filters\Conditions\Email;
use App\Filters\Conditions\EnabledAt;
use App\Filters\Filter;
use App\Models\User;

class UserFilters extends Filter
{
    protected string $model = User::class;
    protected array $applicableConditions = [
        'email' => Email::class,
        'enabled_at' => EnabledAt::class,
        'created_at' => CreatedAt::class,
    ];

    protected function select(): Filter
    {
        $this->query->select(['name', 'email', 'created_at', 'enabled_at']);
        return $this;
    }
}
