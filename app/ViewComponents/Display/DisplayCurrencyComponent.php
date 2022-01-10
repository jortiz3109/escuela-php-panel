<?php

namespace App\ViewComponents\Display;

use App\Helpers\CssHelper;
use Illuminate\View\View;

class DisplayCurrencyComponent extends DisplayComponent
{
    public function renderField(array $model, string $key): View
    {
        return view('partials.display.currency', [
            'value' => $model[$key],
            'valueClass' => CssHelper::getPositionClass($this->valuePosition),
        ]);
    }
}
