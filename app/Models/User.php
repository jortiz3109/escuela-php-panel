<?php

namespace App\Models;

use App\Filters\Concerns\HasFilters;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasFilters;

    protected $fillable = [
        'name',
        'email',
        'password',
        'enabled_at',
    ];

    protected $appends = ['date_formatted',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function logins(): HasMany
    {
        return $this->hasMany(LoginLog::class);
    }

    public function knowDevices(): HasMany
    {
        return $this->hasMany(KnowDevice::class);
    }

    public function isEnabled(): bool
    {
        return null !== $this->enabled_at;
    }

    public function markAsDisabled(): void
    {
        $this->enabled_at = null;

        $this->save();
    }

    public function getDateFormattedAttribute(): string
    {
        return date('d-m-Y', strtotime($this->attributes['created_at']));
    }

    public function getStatusAttribute(): string
    {
        return (is_null($this->attributes['enabled_at'])) ? 'Disabled' : 'Enabled';
    }
}
