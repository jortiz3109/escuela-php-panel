<?php

namespace App\Models;

use App\PropsViews\Constants\PropViewTypes;
use App\PropsViews\Contracts\ShowPropsViews;
use App\PropsViews\Prop;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, ShowPropsViews
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function showProps(): array
    {
        return  [
            new Prop(PropViewTypes::TEXT, trans('users.fields.name'), $this->name),
            new Prop(PropViewTypes::TEXT, trans('users.fields.email'), $this->email),
            new Prop(PropViewTypes::DATE, trans('users.fields.created_at'), $this->created_at),
            new Prop(PropViewTypes::ENABLED, trans('users.fields.status'), $this->isEnabled()),
            new Prop(PropViewTypes::IMAGE, trans('users.fields.name'), 'https://seeklogo.com/images/V/visa-electron-logo-71BEC57E8F-seeklogo.com.png'),
        ];
    }

    public function getTitle(): string
    {
        return $this->name;
    }

    public function getBackRoute(): string
    {
        return route('users.index');
    }

    public function getEditRoute(): string
    {
        return route('users.edit', $this->id);
    }
}
