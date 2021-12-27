<?php

namespace App\ViewModels\Merchants;

use App\Models\Merchant;
use App\ViewModels\Concerns\HasModel;

class MerchantEditViewModel extends MerchantCreateViewModel
{
    use HasModel;

    protected function title(): string
    {
        return trans('merchants.titles.edit');
    }

    protected function data(): array
    {
        return [
            'model' => $this->model,
            'action' => '',
        ];
    }
}
