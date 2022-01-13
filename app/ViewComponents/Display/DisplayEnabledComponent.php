<?php

namespace App\ViewComponents\Display;

use App\Helpers\CssHelper;
use Illuminate\View\View;

class DisplayEnabledComponent extends DisplayComponent
{
    public function renderField(array $resource, string $key = ''): View
    {
        return view('partials.display.table.enabled', [
            'url' => $resource[$key],
            'enabled' => $resource['enabled'],
            'button_enabled' => $resource['button_enabled'],
            'valueClass' => CssHelper::getPositionClass($this->valuePosition),
        ]);
    }
}
