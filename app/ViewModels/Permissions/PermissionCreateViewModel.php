<?php

namespace App\ViewModels\Permissions;

use App\ViewComponents\Inputs\Input;
use App\ViewComponents\Inputs\TextInput;
use App\ViewModels\ViewModel;

abstract class PermissionCreateViewModel extends ViewModel
{
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

    /**
     * @return Input[]
     */
    protected function fields(): array
    {
        return [
            new TextInput(
                trans('permissions.fields.name'),
                'name',
                trans('permissions.placeholders.name'),
                true
            ),
            new TextInput(
                trans('permissions.fields.description'),
                'description',
                trans('permissions.placeholders.description'),
                true
            ),
        ];
    }
}
