<?php

namespace App\ViewModels;

abstract class IndexViewModel extends ViewModel
{
    public function toArray(): array
    {
        return [
            'buttons' => $this->buttons(),
            'texts' => $this->texts(),
            'filters' => $this->filters(),
            'fields' => $this->fields(),
        ] + $this->data();
    }

    protected function buttons(): array
    {
        return [];
    }

    protected function filters(): array
    {
        return [];
    }
}
