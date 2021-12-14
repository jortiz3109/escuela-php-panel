<?php

namespace App\PropsViews;

use App\PropsViews\Contracts\ShowPropsViews;
use Illuminate\View\View;

class TextView extends PropView
{
    public function render(): View
    {
        return view('partials.prop_views.__text', [
            'label' => $this->label,
            'text' => $this->value,
        ]);
    }
}
