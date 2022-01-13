<?php

namespace App\Providers;

use App\Location\Location;
use Illuminate\Support\ServiceProvider;

class LocationProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Location::class, function () {
            $config['route'] = config()->get('location.route');
            $config['apiKey'] = config()->get('location.apiKey');
            return new Location($config);
        });
    }
}
