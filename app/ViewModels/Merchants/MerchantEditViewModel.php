<?php

namespace App\ViewModels\Merchants;

use App\Models\Merchant;
use App\ViewModels\Concerns\HasModel;

class MerchantEditViewModel extends MerchantCreateViewModel
{
    protected function buttons(): array
    {
        return [
            'back' => [
                'text' => trans('common.back'),
                'route' => Merchant::urlPresenter()->show($this->model),
            ],
            'save' => [
                'text' => trans('common.update'),
            ],
        ];
    }

    protected function title(): string
    {
        return trans('merchants.titles.edit');
    }

    public function getAction(): string
    {
        return Merchant::urlPresenter()->update($this->model);
    }
}
