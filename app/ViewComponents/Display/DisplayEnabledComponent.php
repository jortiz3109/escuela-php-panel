<?php

namespace App\ViewComponents\Display;

use App\Helpers\CssHelper;
use Illuminate\View\View;

class DisplayEnabledComponent extends DisplayComponent
{
    public function renderField(array $model, string $key): View
    {
        return view('partials.display.enabled', [
            'url' => $model[$key],
            'enabled' => $model['enabled'],
            'button_enabled' => $model['button_enabled'],
            'valueClass' => CssHelper::getPositionClass($this->valuePosition),
        ]);
    }
}
