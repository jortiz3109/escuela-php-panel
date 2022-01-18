<?php

namespace App\ViewModels\Users;

use App\Models\User;
use App\ViewComponents\Inputs\EmailInput;
use App\ViewComponents\Inputs\PasswordInput;
use App\ViewComponents\Inputs\TextInput;
use App\ViewModels\Concerns\HasCollection;
use App\ViewModels\ViewModel;

class UserCreateViewModel extends ViewModel
{
    use HasCollection;

    protected function buttons(): array
    {
        return [
            'back' => [
                'text' => trans('common.back'),
                'route' => User::urlPresenter()->index(),
            ],
            'save' => [
                'text' => trans('common.create'),
            ],
        ];
    }

    protected function title(): string
    {
        return trans('users.titles.create');
    }

    protected function fields(): array
    {
        return [
            TextInput::create(
                trans('users.labels.name'),
                'name',
                trans('users.placeholders.name'),
            )->required(),
            EmailInput::create(
                trans('users.labels.email'),
                'email',
                trans('users.placeholders.email'),
            )->required(),
            PasswordInput::create(
                trans('users.labels.password'),
                'password',
                trans('users.placeholders.password'),
            )->required(),
            PasswordInput::create(
                trans('users.labels.password_confirmation'),
                'password_confirmation',
                trans('users.placeholders.password_confirmation'),
            )->required(),
        ];
    }

    protected function data(): array
    {
        return [
            'model' => new User(),
            'action' => User::urlPresenter()->store(),
        ];
    }
}
