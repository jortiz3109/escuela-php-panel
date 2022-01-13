<?php

namespace App\ViewComponents\Display;

use App\Helpers\CssHelper;
use Illuminate\View\View;

class DisplayImageComponent extends DisplayComponent
{
    public function renderField(array $resource, string $key = ''): View
    {
        return view('partials.display.table.image', [
            'url' => $resource[$key],
            'valueClass' => CssHelper::getPositionClass($this->valuePosition),
        ]);
    }
}
