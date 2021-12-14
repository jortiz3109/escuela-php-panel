<?php

namespace App\FieldViews;

use Illuminate\View\View;

class ImageView extends FieldView
{
    public function render(): View
    {
        return view('partials.fields_views.__image', [
            'title' => $this->label,
            'url' => $this->value,
        ]);
    }
}
