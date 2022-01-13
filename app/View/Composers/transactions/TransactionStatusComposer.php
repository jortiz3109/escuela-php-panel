<?php

namespace App\View\Composers\transactions;

use App\Constants\TransactionStatus;
use Illuminate\View\View;

class TransactionStatusComposer
{
    public function compose(View $view): void
    {
        $view->with(
            'statuses',
            TransactionStatus::STATUSES,
        );
    }
}
