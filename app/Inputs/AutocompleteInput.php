<?php

namespace App\Inputs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

class AutocompleteInput extends Input
{
    public function render(?Model $model): View
    {
        return view('partials.inputs.autocomplete', ['field' => $this, 'model' => $model]);
    }
}
