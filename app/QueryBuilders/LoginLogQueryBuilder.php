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
}
