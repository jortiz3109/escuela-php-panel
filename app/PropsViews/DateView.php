<?php

namespace App\PropsViews;

use Illuminate\View\View;

class DateView extends PropView
{
    public function render(): View
    {
        return view('partials.prop_views.__date', [
            'label' => $this->label,
            'date' => $this->value,
        ]);
    }
}
