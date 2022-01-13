<?php

namespace App\ViewComponents\Display\Buttons;

use App\ViewComponents\Display\DisplayComponent;
use Illuminate\View\View;

abstract class DisplayButton extends DisplayComponent
{
    protected string $viewName;
    protected string $routeName;
    protected string $routeKey;

    public function __construct(string $routeName, ?string $routeKey = 'id')
    {
        parent::__construct('');

        $this->routeName = $routeName;
        $this->routeKey = $routeKey;
    }

    public function renderField(array $resource, string $key = ''): View
    {
        return view($this->viewName, [
            'route' => route($this->routeName, $resource[$this->routeKey]),
        ]);
    }
}
