<?php

namespace App\ViewComponents\Display;

use App\Helpers\CssHelper;
use Illuminate\View\View;

class DisplayButtonGroup extends DisplayComponent
{
    public function __construct(protected array $buttons)
    {
        parent::__construct('');
    }

    public function renderField(array $model, string $key = ''): View
    {
        return view('partials.display.table.button-group', [
            'model' => $model,
            'buttons' => $this->buttons,
            'valueClass' => CssHelper::getPositionClass($this->valuePosition),
        ]);
    }
}
