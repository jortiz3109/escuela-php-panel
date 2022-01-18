<?php

namespace App\ViewModels\Permissions;

use App\Http\Resources\Permissions\PermissionIndexResource;
use App\ViewComponents\Display\Buttons\DisplayEditButton;
use App\ViewComponents\Display\DisplayButtonGroup;
use App\ViewComponents\Display\DisplayDateComponent;
use App\ViewComponents\Display\DisplayTextComponent;
use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\IndexViewModel;

class PermissionIndexViewModel extends IndexViewModel
{
    use HasPaginator;

    protected function title(): string
    {
        return trans('permissions.titles.index');
    }

    public function filters(): array
    {
        return [
            'name' => old('filters.name') ?? request()->input('filters.name'),
        ];
    }

    protected function fields(): array
    {
        return [
            'name' => DisplayTextComponent::create('permissions.fields.name'),
            'description' => DisplayTextComponent::create('permissions.fields.description'),
            'created_at' => DisplayDateComponent::create('permissions.fields.created_at')->setPositions('center'),
            'button_group' => DisplayButtonGroup::create([
                DisplayEditButton::create('permissions.edit'),
            ])->setValuePosition('center'),
        ];
    }

    protected function data(): array
    {
        return [
            'collection' => $this->collection,
        ];
    }
}
