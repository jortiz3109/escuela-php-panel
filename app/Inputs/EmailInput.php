<?php

namespace App\Inputs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

class EmailInput extends Input
{
    public function render(?Model $model): View
    {
        return view('partials.inputs.email', ['field' => $this, 'model' => $model]);
    }
}
