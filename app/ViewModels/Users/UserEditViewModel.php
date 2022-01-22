<?php

namespace App\ViewModels\Users;

use App\Models\User;
use App\ViewComponents\Inputs\EmailInput;
use App\ViewComponents\Inputs\Input;
use App\ViewComponents\Inputs\TextInput;
use App\ViewModels\Concerns\HasModel;
use App\ViewModels\ViewModel;

class UserEditViewModel extends ViewModel
{
    use HasModel;

    protected function buttons(): array
    {
        return [
            'back' => [
                'text' => trans('common.back'),
                'route' => User::urlPresenter()->index(),
            ],
            'save' => [
                'text' => trans('common.update'),
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
            'action' => $this->getAction(),
        ];
    }

    protected function getAction(): string
    {
        return User::urlPresenter()->update($this->model);
    }
}
