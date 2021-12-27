<?php

namespace App\Helpers;

class CssHelper
{
    protected const POSITION_EQUIVALENT = [
        'center' => 'has-text-centered',
        'left' => 'has-text-left',
        'right' => 'has-text-right',
    ];

    public static function getPositionClass(string $position): string
    {
        return self::POSITION_EQUIVALENT[$position] ?? '';
    }
}
