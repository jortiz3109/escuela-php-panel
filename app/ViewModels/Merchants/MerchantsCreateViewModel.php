<?php

namespace App\ViewModels\Merchants;

use App\Inputs\AutocompleteInput;
use App\Inputs\Input;
use App\Inputs\NumberInput;
use App\Inputs\TextInput;
use App\Inputs\URLInput;
use App\Models\Country;
use App\Models\Currency;
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
    protected function inputs(): array
    {
        return [
            new TextInput(
                trans('merchants.labels.name'),
                trans('merchants.inputs.name'),
                trans('merchants.placeholders.name'),
                true
            ),
            new TextInput(
                trans('merchants.labels.brand'),
                trans('merchants.inputs.brand'),
                trans('merchants.placeholders.brand'),
                true
            ),
            new NumberInput(
                trans('merchants.labels.document'),
                trans('merchants.inputs.document'),
                trans('merchants.placeholders.document'),
                true
            ),
            new URLInput(
                trans('merchants.labels.url'),
                trans('merchants.inputs.url'),
                trans('merchants.placeholders.url'),
                true
            ),
            new AutocompleteInput(
                trans('merchants.labels.country'),
                trans('merchants.inputs.country'),
                trans('merchants.placeholders.country'),
                true,
                json_encode(Country::pluck('name', 'id')->toArray()),
            ),
            new AutocompleteInput(
                trans('merchants.labels.currency'),
                trans('merchants.inputs.currency'),
                trans('merchants.placeholders.currency'),
                true,
                json_encode(Currency::pluck('name', 'id')->toArray()),
            ),
        ];
    }

    protected function data(): array
    {
        return [
            'model' => new Merchant(),
            'action' => '',
        ];
    }
}
