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

    public function filters(): array
    {
        return [];
    }
}
