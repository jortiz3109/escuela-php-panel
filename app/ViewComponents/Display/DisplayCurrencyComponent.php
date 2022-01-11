<?php

namespace App\ViewComponents\Display;

use App\Helpers\CssHelper;
use Illuminate\View\View;

class DisplayCurrencyComponent extends DisplayComponent
{
    public function renderField(array $resource, string $key): View
    {
        return view('partials.display.currency', [
            'value' => $resource[$key],
            'valueClass' => CssHelper::getPositionClass($this->valuePosition),
        ]);
    }
}
