<?php

namespace App\ViewModels\Concerns;

use Illuminate\Support\Collection;

trait HasCollection
{
    protected Collection $collection;

    public function collection(Collection $collection): self
    {
        $this->collection = $collection;
        return $this;
    }
}
