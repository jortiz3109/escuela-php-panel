<?php

namespace App\ViewModels\Concerns;

use Illuminate\Database\Eloquent\Collection;

trait HasCollection
{
    protected Collection $collection;

    public function collection(Collection $collection): self
    {
        $this->collection = $collection;
        return $this;
    }
}
