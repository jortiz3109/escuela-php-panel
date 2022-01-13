<?php

namespace App\Models\Concerns;

use Carbon\Carbon;

trait HasToggle
{
    public function toggle(): void
    {
        if ($this->isEnabled()) {
            $this->markAsDisabled();
        } else {
            $this->markAsEnabled();
        }
    }

    public function isEnabled(): bool
    {
        return !is_null($this->enabled_at);
    }

    public function isVerified(): bool
    {
        return !is_null($this->email_verified_at);
    }

    public function markAsEnabled(): void
    {
        $this->enabled_at = Carbon::now()->toDateTimeString();

        $this->save();
    }

    public function markAsDisabled(): void
    {
        $this->enabled_at = null;

        $this->save();
    }
}
