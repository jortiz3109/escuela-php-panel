<?php

namespace App\ViewModels\Merchants;

use App\ViewModels\Concerns\HasModel;

class MerchantEditViewModel extends MerchantCreateViewModel
{
    use HasModel;

    protected function buttons(): array
    {
        return [
            'back' => [
                'text' => trans('common.back'),
                'route' => $this->model->urlPresenter()->show(),
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
        return $this->model->urlPresenter()->update();
    }
}
