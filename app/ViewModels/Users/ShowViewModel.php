<?php

namespace App\ViewModels\Users;

use App\FieldViews\EnabledView;
use App\FieldViews\FieldView;
use App\FieldViews\TextView;
use App\ViewModels\Concerns\HasModel;
use App\ViewModels\ViewModel;

class ShowViewModel extends ViewModel
{
    use HasModel;

    /**
     * @return FieldView[]
     */
    protected function fields(): array
    {
        return  [
            new TextView(trans('users.fields.name'), $this->model->name),
            new TextView(trans('users.fields.email'), $this->model->email),
            new EnabledView(trans('common.fields.enabled'), $this->model->isEnabled()),
        ];
    }

    protected function buttons(): array
    {
        return [
            'back' => [
                'text' => trans('common.actions.back'),
                'route' => route('users.index'),
            ],
            'edit' => [
                'text' => trans('common.actions.edit'),
                'route' => route('users.edit', $this->model->getKey()),
            ],
        ];
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
