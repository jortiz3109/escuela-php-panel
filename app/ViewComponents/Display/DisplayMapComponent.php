<?php

namespace App\ViewComponents\Display;

use Illuminate\View\View;

class DisplayMapComponent extends DisplayComponent
{
    public function renderTableHeader(): View
    {
        return view('partials.display.table.th-empty');
    }

    public function renderField(array $model, string $key): View
    {
        return view('partials.display.map', [
            'value' => $model[$key],
        ]);
    }
}
