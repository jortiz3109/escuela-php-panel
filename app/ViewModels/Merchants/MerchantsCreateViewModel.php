<?php

namespace App\ViewModels\Merchants;

use App\Inputs\AutocompleteInput;
use App\Inputs\Input;
use App\Inputs\NumberInput;
use App\Inputs\TextInput;
use App\Inputs\URLInput;
use App\Models\Merchant;
use App\ViewModels\ViewModel;

class MerchantsCreateViewModel extends ViewModel
{
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
        return trans('merchants.titles.create');
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
            new AutocompleteInput('Country', 'country_id', 'Search country...', true),
            new AutocompleteInput('Currency', 'currency_id', 'Search currencies...', true),
        ];
    }

    protected function data(): array
    {
        return [
            'model' => new Merchant(),
            'action' => route('merchants.store'),
        ];
    }
}
