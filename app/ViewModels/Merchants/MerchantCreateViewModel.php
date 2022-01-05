<?php

namespace App\ViewModels\Merchants;

use App\Models\Country;
use App\Models\Currency;
use App\Models\DocumentType;
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
                'route' => route('merchants.index'),
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
            new TextInput(
                trans('merchants.labels.name'),
                'name',
                trans('merchants.placeholders.name'),
                true
            ),
            new TextInput(
                trans('merchants.labels.brand'),
                'brand',
                trans('merchants.placeholders.brand'),
                true
            ),
            new AutocompleteInput(
                trans('merchants.labels.document_type'),
                'document_type_id',
                trans('merchants.placeholders.document_type'),
                true,
                $this->documentTypes(),
            ),
            new NumberInput(
                trans('merchants.labels.document'),
                'document',
                trans('merchants.placeholders.document'),
                true
            ),
            new URLInput(
                trans('merchants.labels.url'),
                'url',
                trans('merchants.placeholders.url'),
            ),
            new AutocompleteInput(
                trans('merchants.labels.country'),
                'country_id',
                trans('merchants.placeholders.country'),
                true,
                $this->countries(),
            ),
            new AutocompleteInput(
                trans('merchants.labels.currency'),
                'currency_id',
                trans('merchants.placeholders.currency'),
                true,
                $this->currencies(),
            ),
        ];
    }

    protected function data(): array
    {
        return [
            'model' => $this->model,
            'route' => $this->getRoute(),
        ];
    }

    public function getRoute(): string
    {
        return route('merchants.store');
    }

    public function currencies(): Collection
    {
        return Currency::enabled()->orderBy('alphabetic_code')->get();
    }

    public function countries(): Collection
    {
        return Country::enabled()->orderBy('name')->get();
    }

    public function documentTypes(): Collection
    {
        return DocumentType::all();
    }
}
