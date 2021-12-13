<?php

namespace App\PropsViews;

use App\PropsViews\Contracts\ShowPropsViews;
use Illuminate\View\View;

class DateView extends PropView
{
    public function render(ShowPropsViews $model): View
    {
        return view('partials.prop_views.__date', [
            'label' => $this->label,
            'date' => $this->value,
        ]);
    }
}
