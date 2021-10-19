<?php

namespace App\ViewModels\Concerns;

use Illuminate\Contracts\Pagination\Paginator;

trait HasCollection
{
    protected Paginator $collection;

    public function collection(Paginator $collection): self
    {
        $this->collection = $collection;
        return $this;
    }
}
