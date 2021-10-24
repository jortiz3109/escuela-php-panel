<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class LoginLogQueryBuilder extends Builder
{
    public function lastUserLogins(): self
    {
        $userId = auth()->id();

        return $this->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->take(10);
    }
}
