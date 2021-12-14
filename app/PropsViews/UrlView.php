<?php

namespace App\PropsViews;

use Illuminate\View\View;

class UrlView extends PropView
{
    public function render(): View
    {
        return view('partials.prop_views.__url', [
            'label' => $this->label,
            'url' => $this->value,
        ]);
    }
}
