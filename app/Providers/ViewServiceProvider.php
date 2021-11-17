<?php

namespace App\Providers;

use App\View\Composers\CountryComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('merchants.index', CountryComposer::class);
    }
}
