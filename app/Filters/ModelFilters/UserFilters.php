<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\CreatedAt;
use App\Filters\Conditions\Email;
use App\Filters\Conditions\Status;
use App\Filters\Filter;
use App\Models\User;

class UserFilters extends Filter
{
    protected string $model = User::class;

    protected array $applicableConditions = [
        'email' => Email::class,
        'created_at' => CreatedAt::class,
        'status' => Status::class,
    ];

    protected function select(): Filter
    {
        $this->query->select(['id', 'name', 'email', 'created_at', 'enabled_at', 'email_verified_at']);
        return $this;
    }
}
