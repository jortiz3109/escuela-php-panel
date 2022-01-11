<?php

namespace App\Models\Concerns;

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
}
