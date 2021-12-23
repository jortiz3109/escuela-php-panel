<?php

namespace App\ViewComponents\Display;

use Illuminate\View\View;

class DisplayLinkComponent extends DisplayComponent
{
    private string $routeName;
    private string $routeKey;

    public function __construct(string $label, string $routeName, string $routeKey, ?string $class = '')
    {
        parent::__construct($label, $class);

        $this->routeName = $routeName;
        $this->routeKey = $routeKey;
    }

    public function renderField(array $value, string $key): View
    {
        return view('partials.display.link', [
            'class' => $this->class,
            'route' => route($this->routeName, $value[$this->routeKey]),
            'value' => $value[$key],
        ]);
    }
}
