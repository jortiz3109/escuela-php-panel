<?php

namespace App\Constants;

use App\Models\PaymentMethod;
use App\Models\User;

class Toggle
{
    public const USER = 'user';
    public const PAYMENT_METHOD = 'payment_method';

    public const TOGGLEABLE = [
        self::USER => User::class,
        self::PAYMENT_METHOD => PaymentMethod::class
    ];
}
