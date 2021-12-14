<?php

namespace App\FieldViews;

use Illuminate\View\View;

class TextView extends FieldView
{
    public function render(): View
    {
        return view('partials.prop_views.__text', [
            'label' => $this->label,
            'text' => $this->value,
        ]);
    }
}
