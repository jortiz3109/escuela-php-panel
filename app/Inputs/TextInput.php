<?php

namespace App\Inputs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

class TextInput extends Input
{
    public function render(?Model $model): View
    {
        return view('partials.inputs.text', ['field' => $this, 'model' => $model]);
    }
}
