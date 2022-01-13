<?php

namespace App\ViewModels\Merchants;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Merchant;
use App\ViewComponents\Inputs\AutocompleteInput;
use App\ViewComponents\Inputs\Input;
use App\ViewComponents\Inputs\NumberInput;
use App\ViewComponents\Inputs\TextInput;
use App\ViewComponents\Inputs\URLInput;
use App\ViewModels\ViewModel;

class MerchantCreateViewModel extends ViewModel
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
            TextInput::create(
                trans('merchants.labels.name'),
                'name',
                trans('merchants.placeholders.name'),
            )->required(),

            TextInput::create(
                trans('merchants.labels.brand'),
                'brand',
                trans('merchants.placeholders.brand'),
            )->required(),

            NumberInput::create(
                trans('merchants.labels.document'),
                'document',
                trans('merchants.placeholders.document'),
            )->required(),

            URLInput::create(
                trans('merchants.labels.url'),
                'url',
                trans('merchants.placeholders.url'),
            )->required(),

            AutocompleteInput::create(
                trans('merchants.labels.country'),
                'country',
                trans('merchants.placeholders.country'),
            )->required()
                ->setData(Country::pluck('name', 'id')->toArray()),

            AutocompleteInput::create(
                trans('merchants.labels.currency'),
                'currency',
                trans('merchants.placeholders.currency'),
            )->required()
                ->setData(Currency::pluck('name', 'id')->toArray()),
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
