<?php

namespace App\ViewComponents\Display;

use App\Helpers\CssHelper;
use Illuminate\View\View;

class DisplayExternalURLComponent extends DisplayComponent
{
    public function renderField(array $resource, string $key): View
    {
        return view('partials.display.url', [
            'url' => $resource[$key],
            'class' => CssHelper::getPositionClass($this->valuePosition),
        ]);
    }
}
