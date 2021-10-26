<?php

namespace App\Models;

use App\QueryBuilders\KnowDeviceQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KnowDevice extends Model
{
    use HasFactory;

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = null;

    protected $fillable = [
        'user_agent',
        'last_login_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function logins(): HasMany
    {
        return $this->hasMany(LoginLog::class, 'device_id');
    }

    public function newEloquentBuilder($query): KnowDeviceQueryBuilder
    {
        return new KnowDeviceQueryBuilder($query);
    }
}
