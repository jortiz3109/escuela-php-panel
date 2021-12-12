<?php

namespace App\Inputs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

class URLInput extends Input
{
    public function render(?Model $model): View
    {
        return view('partials.inputs.url', ['field' => $this, 'model' => $model]);
    }
}
