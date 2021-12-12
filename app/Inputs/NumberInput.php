<?php

namespace App\Inputs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

class NumberInput extends Input
{
    public function render(?Model $model): View
    {
        return view('partials.inputs.number', ['field' => $this, 'model' => $model]);
    }
}
