<?php
namespace App\Filters\ModelFilters;

use App\Filters\Conditions\Email;
use App\Filters\Conditions\EnabledAt;
use App\Filters\Conditions\Name;
use App\Filters\Filter;
use App\Models\User;

class UserFilters extends Filter
{
    protected string $model = User::class;
    protected array $applicableConditions = [
        'name' => Name::class,
        'email' => Email::class,
        'enabled_at' => EnabledAt::class,
    ];

    protected function select(): Filter
    {
        $this->query->select(['id', 'name', 'email', 'created_at', 'updated_at', 'enabled_at']);
        return $this;
    }
}

