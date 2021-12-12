<?php

namespace App\ViewModels\Merchants;

use App\Inputs\Input;
use App\Inputs\NumberInput;
use App\Inputs\TextInput;
use App\Inputs\URLInput;
use App\Models\Merchant;
use App\ViewModels\ViewModel;

class MerchantsCreateOrEditViewModel extends ViewModel
{
    public function __construct(public ?Merchant $merchant = null)
    {
    }

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
        return $this->merchant ? trans('merchants.titles.edit') : trans('merchants.titles.create');
    }

    /**
     * @return Input[]
     */
    protected function fields(): array
    {
        return [
            new TextInput('Name', 'name', 'Enter merchant name...', true),
            new TextInput('Brand', 'brand', 'Enter merchant brand...', true),
            new NumberInput('Document', 'document', 'Enter merchant document...', true),
            new URLInput('URL', 'url', 'Enter merchant URL...'),
        ];
    }

    protected function data(): array
    {
        return [
            'model' => $this->merchant,
            'action' => $this->merchant ? route('merchants.update', $this->merchant) : route('merchants.store'),
        ];
    }
}
