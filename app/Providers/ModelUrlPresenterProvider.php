<?php

namespace App\Providers;

use App\Presenters\Url\UrlPresenter;
use Illuminate\Support\ServiceProvider;

class ModelUrlPresenterProvider extends ServiceProvider
{
    private string $namespace = 'App\\Presenters\\Url\\';

    public function register(): void
    {
        $this->app->singleton(UrlPresenter::class, function ($app, array $params) {
            $presenterName = $this->presenterName($params['modelName']);
            return new $presenterName($params['modelName']);
        });
    }

    private function presenterName(string $modelName): string
    {
        return $this->namespace . class_basename($modelName) . 'UrlPresenter';
    }
}
