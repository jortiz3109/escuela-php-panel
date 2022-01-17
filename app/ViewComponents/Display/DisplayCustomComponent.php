<?php

namespace App\ViewComponents\Display;

use Illuminate\View\View;

class DisplayCustomComponent extends DisplayComponent
{
    public string $view;

    public function renderField(array $resource, string $key = ''): View
    {
        return view($this->view, compact('resource'));
    }

    public function setView(string $view): static
    {
        $this->view = $view;

        return $this;
    }
}
