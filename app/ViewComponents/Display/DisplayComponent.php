<?php

namespace App\ViewComponents\Display;

use App\Helpers\CssHelper;
use Illuminate\View\View;

abstract class DisplayComponent
{
    protected string $header;
    protected string $headerPosition = 'left';
    protected string $valuePosition = 'left';

    public function __construct(string $header)
    {
        $this->header = $header;
    }

    public static function create(...$params): static
    {
        return new static(...$params);
    }

    public function renderTableHeader(): View
    {
        return view('partials.display.table.th', [
            'label' => $this->header,
            'labelClass' => CssHelper::getPositionClass($this->headerPosition),
        ]);
    }

    public function setHeaderPosition(string $position): static
    {
        $this->headerPosition = $position;

        return $this;
    }

    public function setValuePosition(string $position): static
    {
        $this->valuePosition = $position;

        return $this;
    }

    public function setPositions(string $position): static
    {
        $this->headerPosition = $position;
        $this->valuePosition = $position;

        return $this;
    }

    abstract public function renderField(array $resource, string $key): View;
}
