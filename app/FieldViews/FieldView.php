<?php

namespace App\FieldViews;

use Illuminate\View\View;

abstract class FieldView
{
    public function __construct(
        public string $label,
        public string $value
    ) {
    }

    abstract public function render(): View;
}
