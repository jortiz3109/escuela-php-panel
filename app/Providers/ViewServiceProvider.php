<?php

namespace App\Providers;

use App\View\Composers\CountryComposer;
use App\View\Composers\CurrencyComposer;
use App\View\Composers\PaymentMethodsComposer;
use App\View\Composers\transactions\TransactionStatusComposer;
use App\View\Composers\users\UserStatusComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('users.index', UserStatusComposer::class);
        View::composer('merchants.index', CountryComposer::class);
        View::composer('merchants.index', CurrencyComposer::class);
        View::composer('modules.index', TransactionStatusComposer::class);
        View::composer('modules.index', PaymentMethodsComposer::class);
    }
}
