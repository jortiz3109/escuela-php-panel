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
                'route' => route('merchants.show', $this->model),
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
        return route('merchants.update', $this->model);
    }
}
