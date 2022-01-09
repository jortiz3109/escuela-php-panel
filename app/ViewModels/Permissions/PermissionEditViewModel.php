<?php

namespace App\ViewModels\Permissions;

use App\ViewComponents\Inputs\Input;
use App\ViewComponents\Inputs\TextInput;
use App\ViewModels\Concerns\HasModel;
use App\ViewModels\ViewModel;

class PermissionEditViewModel extends ViewModel
{
    use HasModel;

    protected function buttons(): array
    {
        return [
            'back' => [
                'text' => trans('common.back'),
                'route' => route('permissions.index'),
            ],
            'save' => [
                'text' => trans('common.save'),
            ],
        ];
    }

    protected function title(): string
    {
        return trans('permissions.titles.edit');
    }

    /**
     * @return Input[]
     */
    protected function fields(): array
    {
        return [
            TextInput::create(
                trans('permissions.fields.name'),
                'name',
                trans('permissions.placeholders.name'),
            )->disabled(),

            TextInput::create(
                trans('permissions.fields.description'),
                'description',
                trans('permissions.placeholders.description'),
            )->required(),
        ];
    }

    protected function data(): array
    {
        return [
            'model' => $this->model,
            'route' => route('permissions.update', $this->model->id),
        ];
    }
}
