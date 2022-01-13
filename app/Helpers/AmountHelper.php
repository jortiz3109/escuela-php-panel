<?php

namespace App\Helpers;

use Money\Currency as MoneyCurrency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;

class AmountHelper
{
    public static function format(int $amount, string $currency, ?string $symbol = ''): string
    {
        $money = new Money($amount, new MoneyCurrency($currency));

        return $symbol . app(IntlMoneyFormatter::class)->format($money);
    }
}
