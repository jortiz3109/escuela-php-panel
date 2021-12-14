<?php

namespace App\ViewModels;

use App\PropsViews\PropView;
use App\ViewModels\Concerns\HasDisplayable;

class ShowViewModelBase extends ViewModel
{
    use HasDisplayable;

    public function toArray(): array
    {
        return [
                'buttons' => $this->buttons(),
                'texts' => $this->texts(),
                'fields' => $this->fields(),
            ] + $this->data();
    }

    /**
     * @return PropView[]
     */
    protected function fields(): array
    {
        return  [];
    }

    protected function buttons(): array
    {
        return [];
    }

    protected function title(): string
    {
        return $this->model->name;
    }

    protected function data(): array
    {
        return ['model' => $this->model];
    }
}
