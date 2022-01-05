<?php

namespace App\ViewModels\Users;

use App\ViewComponents\Inputs\EmailInput;
use App\ViewComponents\Inputs\Input;
use App\ViewComponents\Inputs\TextInput;
use App\ViewModels\Concerns\HasModel;
use App\ViewModels\ViewModel;

class UserEditViewModel extends ViewModel
{
    use HasModel;

    // TODO: Users index route on back button
    protected function buttons(): array
    {
        return [
            'back' => [
                'text' => trans('common.back'),
                'route' => '',
            ],
            'save' => [
                'text' => trans('common.save'),
            ],
        ];
    }

    protected function title(): string
    {
        return trans('users.titles.edit');
    }

    /**
     * @return Input[]
     */
    protected function fields(): array
    {
        return [
            TextInput::create(
                trans('users.fields.name'),
                'name',
                trans('users.placeholders.name'),
            )->required(),

            EmailInput::create(
                trans('users.fields.email'),
                'email',
                trans('users.placeholders.email'),
            )->required(),
        ];
    }

    protected function data(): array
    {
        return [
            'model' => $this->model,
            'action' => '',
        ];
    }
}
