<?php

namespace App\Models;

use App\Filters\Concerns\HasFilters;
use App\Models\Concerns\HasToggle;
use App\Models\Contracts\ToggleInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, ToggleInterface
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasFilters;
    use HasToggle;
    use HasUrlPresenter;

    protected $fillable = [
        'name',
        'email',
        'password',
        'created_by',
        'updated_by',
        'enabled_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'enabled_at',
    ];

    public function logins(): HasMany
    {
        return $this->hasMany(LoginLog::class);
    }

    public function knowDevices(): HasMany
    {
        return $this->hasMany(KnowDevice::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function isEnabled(): bool
    {
        return null !== $this->enabled_at;
    }

    public function disableEmailVerification(): void
    {
        $this->email_verified_at = null;

        $this->save();
    }

    public function isEmailVerified(): bool
    {
        return null !== $this->email_verified_at;
    }

    public function hasPermission(string $permissionName): bool
    {
        return (bool)$this->permissions->firstWhere('name', $permissionName);
    }
}
