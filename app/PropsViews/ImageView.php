<?php

namespace App\PropsViews;

use App\PropsViews\Contracts\ShowPropsViews;
use Illuminate\View\View;

class ImageView extends PropView
{
    public function render(): View
    {
        return view('partials.prop_views.__image', [
            'title' => $this->label,
            'url' => $this->value,
        ]);
    }
}
