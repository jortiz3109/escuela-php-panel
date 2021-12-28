<?php

namespace App\ViewComponents\Inputs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

abstract class Input
{
    public function __construct(
        public string $label,
        public string $name,
        public string $placeholder = '',
        public bool $required = false,
        public string $data = ''
    ) {
    }

    public function render(?Model $model): View
    {
        return view('partials.inputs.' . $this->partial, ['field' => $this, 'model' => $model]);
    }
}
