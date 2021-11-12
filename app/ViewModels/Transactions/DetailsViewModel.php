<?php

namespace App\ViewModels\Transactions;

use App\ViewModels\Concerns\HasModel;
use App\ViewModels\ViewModel;

class DetailsViewModel extends ViewModel
{
    use HasModel;

    protected function buttons(): array
    {
        return [];
    }

    protected function title(): string
    {
        return trans('transactions.titles.details');
    }

    protected function data(): array
    {
        return [
            'transaction'  => $this->model,
            'payer' => json_decode($this->model->payer),
            'buyer' => json_decode($this->model->buyer),
        ];
    }
}
