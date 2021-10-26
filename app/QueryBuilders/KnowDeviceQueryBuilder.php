<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class KnowDeviceQueryBuilder extends Builder
{
    public function currentDeviceExists(): bool
    {
        return $this->currentDevice()->exists();
    }

    public function currentDevice(): self
    {
        return $this->where('user_agent', request()->userAgent());
    }
}
