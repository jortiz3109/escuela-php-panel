<?php

namespace App\ViewModels;

use Illuminate\Contracts\Support\Arrayable;

abstract class ViewModel implements Arrayable
{
    public function toArray(): array
    {
        return [
            'buttons' => $this->buttons(),
            'texts' => $this->texts(),
            'fields' => $this->fields(),
        ] + $this->data();
    }

    protected function texts(): array
    {
        return [
            'title' => $this->title(),
        ];
    }

    protected function fields(): array
    {
        return [];
    }

    abstract protected function buttons(): array;
    abstract protected function title(): string;
    abstract protected function data(): array;
}
