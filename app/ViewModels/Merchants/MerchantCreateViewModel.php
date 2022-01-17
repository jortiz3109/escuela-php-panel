<?php

namespace App\ViewModels\Merchants;

use App\Models\Country;
use App\Models\Currency;
use App\Models\DocumentType;
use App\Models\Merchant;
use App\ViewComponents\Inputs\AutocompleteInput;
use App\ViewComponents\Inputs\Input;
use App\ViewComponents\Inputs\NumberInput;
use App\ViewComponents\Inputs\TextInput;
use App\ViewComponents\Inputs\URLInput;
use App\ViewModels\Concerns\HasModel;
use App\ViewModels\ViewModel;
use Illuminate\Database\Eloquent\Collection;

class MerchantCreateViewModel extends ViewModel
{
    use HasModel;

    protected function buttons(): array
    {
        return [
            'back' => [
                'text' => trans('common.back'),
                'route' => Merchant::urlPresenter()->index(),
            ],
            'save' => [
                'text' => trans('common.create'),
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

            AutocompleteInput::create(
                trans('merchants.labels.document_type'),
                'document_type_id',
                trans('merchants.placeholders.document_type'),
            )->required()
                ->setData($this->documentTypes()),

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
                'country_id',
                trans('merchants.placeholders.country'),
            )->required()
                ->setData($this->countries()),

            AutocompleteInput::create(
                trans('merchants.labels.currency'),
                'currency_id',
                trans('merchants.placeholders.currency'),
            )->required()
                ->setData($this->currencies()),
        ];
    }

    protected function data(): array
    {
        return [
            'model' => $this->model,
            'action' => $this->getAction(),
        ];
    }

    public function getAction(): string
    {
        return route('merchants.store');
    }

    public function currencies(): Collection
    {
        return Currency::enabled()->orderBy('alphabetic_code')->get(['id', 'name']);
    }

    public function countries(): Collection
    {
        return Country::enabled()->orderBy('name')->get(['id', 'name']);
    }

    public function documentTypes(): Collection
    {
        return DocumentType::all(['id', 'name']);
    }
}
