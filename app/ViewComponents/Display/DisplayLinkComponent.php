<?php

namespace App\ViewComponents\Display;

use App\Helpers\CssHelper;
use Illuminate\View\View;

class DisplayLinkComponent extends DisplayComponent
{
    private string $routeName;
    private string $routeKey;

    public function __construct(string $header, string $routeName, string $routeKey)
    {
        parent::__construct($header);

        $this->routeName = $routeName;
        $this->routeKey = $routeKey;
    }

    public function renderField(array $resource, string $key = ''): View
    {
        return view('partials.display.table.link', [
            'route' => route($this->routeName, $resource[$this->routeKey]),
            'value' => $resource[$key],
            'valueClass' => CssHelper::getPositionClass($this->valuePosition),
        ]);
    }
}
