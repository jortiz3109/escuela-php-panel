<?php

namespace App\PropsViews\Contracts;

use App\PropsViews\Prop;

interface ShowPropsViews
{
    /** @return Prop[] */
    public function showProps(): array;

    public function getTitle(): string;

    public function getBackRoute(): string;

    public function getEditRoute(): string;
}
