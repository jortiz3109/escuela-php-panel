<?php

namespace App\ViewModels\Merchants;

use App\FieldViews\FieldView;
use App\FieldViews\TextView;
use App\FieldViews\UrlView;
use App\ViewModels\Concerns\HasModel;
use App\ViewModels\ViewModel;

class ShowViewModel extends ViewModel
{
    use HasModel;

    /**
     * @return FieldView[]
     */
    protected function fields(): array
    {
        $docType = $this->model->documentType->code;
        $doc = $this->model->document;
        return  [
            new TextView(trans('merchants.fields.name'), $this->model->name),
            new TextView(trans('merchants.fields.document'), $docType . ': ' . $doc),
            new TextView(trans('merchants.fields.brand'), $this->model->brand),
            new TextView(trans('merchants.fields.country'), $this->model->country->name),
            new TextView(trans('merchants.fields.currency'), $this->model->currency->alphabetic_code),
            new UrlView(trans('merchants.fields.url'), $this->model->url),
        ];
    }

    protected function buttons(): array
    {
        return [
            'back' => [
                'text' => trans('common.actions.back'),
                'route' => route('merchants.index'),
            ],
            'edit' => [
                'text' => trans('common.actions.edit'),
                'route' => route('merchants.edit', $this->model->getKey()),
            ],
        ];
    }

    protected function title(): string
    {
        return $this->model->name;
    }

    protected function data(): array
    {
        return ['model' => $this->model];
    }
}
