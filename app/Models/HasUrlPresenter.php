<?php

namespace App\Models;

use App\Presenters\Url\UrlPresenter;

trait HasUrlPresenter
{
    public static function urlPresenter(): UrlPresenter
    {
        return app()->make(UrlPresenter::class, ['modelName' => get_called_class()]);
    }
}
