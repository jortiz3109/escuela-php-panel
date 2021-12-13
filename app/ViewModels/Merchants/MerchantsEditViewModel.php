<?php

namespace App\ViewModels\Merchants;

use App\Models\Merchant;

class MerchantsEditViewModel extends MerchantsCreateViewModel
{
    public function __construct(public ?Merchant $merchant = null)
    {
    }

    protected function title(): string
    {
        return trans('merchants.titles.edit');
    }

    protected function data(): array
    {
        return [
            'model' => $this->merchant,
            'action' => route('merchants.update', $this->merchant),
        ];
    }
}
