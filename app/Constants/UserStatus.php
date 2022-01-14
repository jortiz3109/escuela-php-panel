<?php

namespace App\Constants;

class UserStatus
{
    public const STATUS_ENABLED = 'ENABLED';
    public const STATUS_DISABLED = 'DISABLED';

    public const STATUSES = [
        self::STATUS_ENABLED,
        self::STATUS_DISABLED,
    ];
}
