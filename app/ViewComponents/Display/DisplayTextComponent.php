<?php

namespace App\ViewComponents\Display;

use App\Helpers\CssHelper;
use Illuminate\View\View;

class DisplayTextComponent extends DisplayComponent
{
    public function renderField(array $model, string $key = ''): View
    {
        return view('partials.display.table.text', [
            'value' => $model[$key],
            'valueClass' => CssHelper::getPositionClass($this->valuePosition),
        ]);
    }
}
