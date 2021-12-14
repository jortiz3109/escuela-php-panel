<?php

namespace App\FieldViews;

use Illuminate\View\View;

class DateView extends FieldView
{
    public function render(): View
    {
        return view('partials.fields_views.__date', [
            'label' => $this->label,
            'date' => $this->value,
        ]);
    }
}
