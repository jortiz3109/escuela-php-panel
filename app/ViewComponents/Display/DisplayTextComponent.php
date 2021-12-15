<?php

namespace App\ViewComponents\Display;

use Illuminate\View\View;

class DisplayTextComponent extends DisplayComponent
{
    public function renderField(array $value, string $key): View
    {
        return view('partials.display.text', [
            'class' => $this->class,
            'value' => $value[$key],
        ]);
    }
}
