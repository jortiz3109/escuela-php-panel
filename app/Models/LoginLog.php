<?php

namespace App\Models;

use App\QueryBuilders\LoginLogQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoginLog extends Model
{
    use HasFactory;

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = null;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function device(): BelongsTo
    {
        return $this->belongsTo(KnowDevice::class);
    }

    public function newEloquentBuilder($query): LoginLogQueryBuilder
    {
        return new LoginLogQueryBuilder($query);
    }
}
