<?php

namespace App\Models;

use Illuminate\Support\Str;

trait HasUUID
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
}
