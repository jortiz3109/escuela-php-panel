<?php

namespace App\Providers;

use App\View\Composers\CountryComposer;
use App\View\Composers\CurrencyComposer;
use App\View\Composers\PaymentMethodsComposer;
use App\View\Composers\StatusComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('merchants.index', CountryComposer::class);
        View::composer('merchants.index', CurrencyComposer::class);
        View::composer('modules.index', StatusComposer::class);
        View::composer('modules.index', PaymentMethodsComposer::class);
    }
}
