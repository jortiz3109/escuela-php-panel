<?php

namespace App\View\Composers;

use App\Constants\TransactionStatus;
use Illuminate\View\View;

class StatusComposer
{
    public function compose(View $view): void
    {
        $view->with(
            'statuses',
            TransactionStatus::STATUSES,
        );
    }
}
