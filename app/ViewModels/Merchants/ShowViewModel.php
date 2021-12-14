<?php

namespace App\ViewModels\Merchants;

use App\PropsViews\PropView;
use App\PropsViews\TextView;
use App\PropsViews\UrlView;
use App\ViewModels\ShowViewModelBase;

class ShowViewModel extends ShowViewModelBase
{
    /**
     * @return PropView[]
     */
    protected function fields(): array
    {
        $docType = $this->model->documentType->code;
        $doc = $this->model->document;
        return  [
            new TextView(trans('merchants.fields.name'), $this->model->name),
            new TextView(trans('merchants.fields.document'), $docType . ': ' . $doc),
            new TextView(trans('merchants.fields.brand'), $this->model->brand),
            new TextView(trans('merchants.fields.country'), $this->model->country->alpha_three_code),
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
}
