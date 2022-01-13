<?php

namespace App\ViewComponents\Inputs;

class AutocompleteInput extends Input
{
    public string $data = '';
    protected string $partial = 'autocomplete';

    public function setData(array $data): self
    {
        $this->data = json_encode($data);

        return $this;
    }
}
