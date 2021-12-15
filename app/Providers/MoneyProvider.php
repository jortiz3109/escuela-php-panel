<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use NumberFormatter;

class MoneyProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(IntlMoneyFormatter::class, function ($app) {
            $currencies = new ISOCurrencies();
            $numberFormatter = new NumberFormatter($app->getLocale(), NumberFormatter::DECIMAL);

            return new IntlMoneyFormatter($numberFormatter, $currencies);
        });
    }
}
