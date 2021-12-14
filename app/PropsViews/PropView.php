<?php

namespace App\PropsViews;

use Illuminate\View\View;

abstract class PropView
{
    public function __construct(
        public string $label,
        public string $value
    ) {
    }

    abstract public function render(): View;
}
