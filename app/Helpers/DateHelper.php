<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function toDateString(string|null|Carbon $date): string
    {
        if (is_null($date)) {
            return '';
        }

        if (is_string($date)) {
            $date = Carbon::parse($date);
        }

        return $date->toDateString();
    }
}
