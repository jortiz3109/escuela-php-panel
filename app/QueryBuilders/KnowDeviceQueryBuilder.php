<?php

namespace App\QueryBuilders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class KnowDeviceQueryBuilder extends Builder
{
    public function currentDeviceExistsAndIsRecent(): bool
    {
        $elapsedMonths = config('auth.months_elapsed_to_consider_a_device_as_ancient', 6);

        return $this->currentDevice()
            ->where("last_login_at", ">", Carbon::now()->subMonths($elapsedMonths))
            ->exists();
    }

    public function currentDevice(): self
    {
        return $this->where('user_agent', request()->userAgent());
    }
}
