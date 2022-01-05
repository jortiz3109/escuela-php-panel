<?php

namespace App\ViewComponents\Inputs;

use Illuminate\Database\Eloquent\Collection;

class AutocompleteInput extends Input
{
    protected string $partial = 'autocomplete';

    public Collection $data;

    public function setData(Collection $data): self
    {
        $this->data = $data;

        return $this;
    }
}
