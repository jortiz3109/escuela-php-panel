<?php

namespace App\PropsViews;

class Prop
{
    public function __construct(public string $type, public string $label, public string $value)
    {
    }
}
