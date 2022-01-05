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
                'route' => route('merchants.index'),
            ],
            'save' => [
                'text' => trans('common.save'),
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
            new TextInput(
                trans('users.labels.name'),
                trans('users.inputs.name'),
                trans('users.placeholders.name'),
                true
            ),
            new EmailInput(
                trans('users.labels.email'),
                trans('users.inputs.email'),
                trans('users.placeholders.email'),
            ),
            new PasswordInput(
                trans('users.labels.password'),
                trans('users.inputs.password'),
                trans('users.placeholders.password'),
            ),
            new PasswordInput(
                trans('users.labels.password_confirmation'),
                trans('users.inputs.password_confirmation'),
                trans('users.placeholders.password_confirmation'),
            ),
        ];
    }

    protected function data(): array
    {
        return [
            'model' => new User(),
            'action' => 'users.store',
        ];
    }
}
