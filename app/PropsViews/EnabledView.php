<?php

namespace App\PropsViews;

use App\PropsViews\Contracts\ShowPropsViews;
use Illuminate\View\View;

class EnabledView extends PropView
{
    public function render(ShowPropsViews $model): View
    {
        return view('partials.prop_views.__enabled', [
            'label' => $this->label,
            'value' => $this->value,
        ]);
    }
}
