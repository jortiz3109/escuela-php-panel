<?php

namespace App\ViewModels;

use App\Inputs\Input;
use Illuminate\Contracts\Support\Arrayable;

abstract class ViewModel implements Arrayable
{
    public function toArray(): array
    {
        return [
            'buttons' => $this->buttons(),
            'texts' => $this->texts(),
            'filters' => $this->filters(),
            'fields' => $this->inputs(),
            'headers' => $this->headers(),
        ] + $this->data();
    }

    protected function texts(): array
    {
        return [
            'title' => $this->title(),
        ];
    }

    protected function filters(): array
    {
        return [];
    }

    protected function buttons(): array
    {
        return [];
    }

    protected function headers(): array
    {
        return ['actions' => trans('common.actions')];
    }

    protected function data(): array
    {
        return [];
    }

    /**
     * @return Input[]
     */
    protected function inputs(): array
    {
        return [];
    }

    abstract protected function title(): string;
}
