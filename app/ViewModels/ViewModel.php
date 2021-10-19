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
            ] + $this->data();
    }

    abstract protected function buttons(): array;

    protected function texts(): array
    {
        return [
            'title' => $this->title(),
        ];
    }

    abstract protected function title(): string;

    abstract protected function data(): array;
}
