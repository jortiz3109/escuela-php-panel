<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class LoginLogQueryBuilder extends Builder
{
    public function lastUserLogins(): self
    {
        return $this->orderByDesc('created_at')
            ->take(10);
    }

    public function deviceExists(string $ipAddress, string $userAgent): bool
    {
        return $this->where('ip_address', $ipAddress)
            ->where('user_agent', $userAgent)
            ->exists();
    }
}
