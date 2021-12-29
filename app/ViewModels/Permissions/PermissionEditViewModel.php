<?php

namespace App\ViewModels\Permissions;

use App\ViewModels\Concerns\HasModel;

class PermissionEditViewModel extends PermissionCreateViewModel
{
    use HasModel;

    protected function title(): string
    {
        return trans('permissions.titles.edit');
    }

    protected function data(): array
    {
        return [
            'model' => $this->model,
            'action' => '',
        ];
    }
}
