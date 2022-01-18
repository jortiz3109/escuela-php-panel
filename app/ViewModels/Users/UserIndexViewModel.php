<?php

namespace App\ViewModels\Users;

use App\Http\Resources\Users\UsersIndexResource;
use App\Models\User;
use App\ViewComponents\Display\Buttons\DisplayEditButton;
use App\ViewComponents\Display\DisplayButtonGroup;
use App\ViewComponents\Display\DisplayDateComponent;
use App\ViewComponents\Display\DisplayEnabledComponent;
use App\ViewComponents\Display\DisplayTextComponent;
use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\IndexViewModel;

class UserIndexViewModel extends IndexViewModel
{
    use HasPaginator;

    protected function buttons(): array
    {
        return [
            'create' => [
                'text' => trans('users.buttons.save'),
                'route' => User::urlPresenter()->create(),
            ],
        ];
    }

    protected function title(): string
    {
        return trans('users.titles.index');
    }

    public function filters(): array
    {
        return [
            'email' => old('filters.email') ?? request()->input('filters.email'),
            'created_at' => old('filters.created_at') ?? request()->input('filters.created_at'),
            'status_enabled' => old('filters.status_enabled') ?? request()->input('filters.status_enabled'),
        ];
    }

    protected function fields(): array
    {
        return [
            'name' => DisplayTextComponent::create('users.fields.name'),
            'email' => DisplayTextComponent::create('users.fields.email'),
            'created_at' => DisplayDateComponent::create('users.fields.created_at'),
            'url' => DisplayEnabledComponent::create('common.status'),
            'button_group' => DisplayButtonGroup::create([
                DisplayEditButton::create('users.edit'),
            ])->setValuePosition('center'),
        ];
    }

    protected function data(): array
    {
        return [
            'collection' => UsersIndexResource::collection($this->collection),
        ];
    }
}
