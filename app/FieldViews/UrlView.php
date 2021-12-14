<?php

namespace App\FieldViews;

use Illuminate\View\View;

class UrlView extends FieldView
{
    public function render(): View
    {
        return view('partials.fields_views.__url', [
            'label' => $this->label,
            'url' => $this->value,
        ]);
    }
}
