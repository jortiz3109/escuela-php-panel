<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

trait HasEnabled
{
    public static function scopeEnabled(Builder $query): Builder
    {
        return $query->whereNotNull('enabled_at');
    }
}
