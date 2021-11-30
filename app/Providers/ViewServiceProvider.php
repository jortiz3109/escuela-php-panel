<?php

namespace App\Providers;

use App\View\Composers\CountryComposer;
use App\View\Composers\CurrencyComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('merchants.index', CountryComposer::class);
        View::composer('merchants.index', CurrencyComposer::class);
    }
}
