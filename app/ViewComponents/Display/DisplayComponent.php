<?php

namespace App\ViewComponents\Display;

use Illuminate\View\View;

abstract class DisplayComponent
{
    protected string $label;
    protected string $class;

    public function __construct(string $label, ?string $class = '')
    {
        $this->label = $label;
        $this->class = $class;
    }

    public function renderLabel(): View
    {
        return view('partials.display.label', [
            'label' => $this->label,
            'class' => $this->class,
        ]);
    }

    abstract public function renderField(array $value, string $key): View;
}
