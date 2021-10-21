<?php

namespace App\Filters\Conditions;

use Illuminate\Database\Eloquent\Builder;

class Email
{
    public static function append(Builder $query, string $email): void
    {
        $query->where('email', 'like', "%{$email}%");
    }
}
