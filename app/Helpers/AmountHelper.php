<?php

namespace App\Helpers;

use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;

class AmountHelper
{
    public static function format(int $amount, string $currency)
    {
        $money = new Money($amount, new Currency($currency));
        return app(IntlMoneyFormatter::class)->format($money);
    }
}
