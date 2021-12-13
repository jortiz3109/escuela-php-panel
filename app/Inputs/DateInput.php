<?php

namespace App\Inputs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

class DateInput extends Input
{
    public function render(?Model $model): View
    {
        return view('partials.inputs.date', ['field' => $this, 'model' => $model]);
    }
}
