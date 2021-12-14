<?php

namespace App\FieldViews;

use Illuminate\View\View;

class EnabledView extends FieldView
{
    public function render(): View
    {
        return view('partials.prop_views.__enabled', [
            'label' => $this->label,
            'value' => $this->value,
        ]);
    }
}
