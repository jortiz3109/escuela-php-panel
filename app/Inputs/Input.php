<?php

namespace App\Inputs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

abstract class Input
{
    public function __construct(
        public string $label,
        public string $name,
        public string $placeholder = '',
        public bool $required = false,
        public array $data = []
    ) {
    }


    abstract public function render(?Model $model): View;
}
