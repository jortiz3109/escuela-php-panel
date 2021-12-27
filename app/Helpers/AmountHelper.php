<?php

namespace App\Helpers;

use App\Models\Currency;
use Money\Currency as MoneyCurrency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;

class AmountHelper
{
    public static function format(int $amount, string $currency): string
    {
        $money = new Money($amount, new MoneyCurrency($currency));
        $symbol = optional(Currency::firstWhere('alphabetic_code', $currency))->symbol;

        return $symbol . app(IntlMoneyFormatter::class)->format($money);
    }
}
