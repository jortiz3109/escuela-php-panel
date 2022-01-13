<?php

namespace App\ViewComponents\Inputs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

abstract class Input
{
    public bool $required = false;
    public bool $disabled = false;

    public function __construct(
        public string $label,
        public string $name,
        public string $placeholder = ''
    ) {
    }

    public static function create(string $label, string $name, ?string $placeholder = ''): static
    {
        return new static($label, $name, $placeholder);
    }

    public function required(): self
    {
        $this->required = true;
        return $this;
    }

    public function disabled(): self
    {
        $this->disabled = true;
        return $this;
    }

    public function render(?Model $model): View
    {
        return view('partials.inputs.' . $this->partial, ['field' => $this, 'model' => $model]);
    }
}
