<?php

namespace App\ViewModels;

use App\PropsViews\Constants\PropViewTypes;
use App\PropsViews\PropView;
use App\ViewModels\Concerns\HasDisplayable;

class ShowViewModel extends ViewModel
{
    use HasDisplayable;

    public function toArray(): array
    {
        return [
                'buttons' => $this->buttons(),
                'texts' => $this->texts(),
                'propsViews' => $this->propsViews(),
                'filters' => $this->filters(),
            ] + $this->data();
    }

    /**
     * @return PropView[]
     */
    private function propsViews(): array
    {
        /** @var $props PropView[] */
        $props = [];
        foreach ($this->model->showProps() as $prop) {
            $type = PropViewTypes::getTypeClasses()[$prop->type];
            array_push($props, new $type($prop->label, $prop->value));
        }

        return $props;
    }

    protected function buttons(): array
    {
        return [
            'back' => [
                'text' => trans('common.actions.back'),
                'route' => $this->model->getBackRoute(),
            ],
            'edit' => [
                'text' => trans('common.actions.edit'),
                'route' => $this->model->getEditRoute(),
            ],
        ];
    }

    protected function title(): string
    {
        return $this->model->getTitle();
    }

    protected function data(): array
    {
        return ['model' => $this->model];
    }
}
