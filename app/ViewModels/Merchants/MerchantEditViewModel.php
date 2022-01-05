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
                'route' => $this->model->presenter()->show(),
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

    public function getRoute(): string
    {
        return $this->model->presenter()->update();
    }
}
