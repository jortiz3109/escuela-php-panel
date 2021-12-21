<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PaymentMethodsComposer
{
    public function compose(View $view): void
    {
        $view->with(
            'payment_methods',
            DB::table('payment_methods')->select(['id', 'name'])->orderBy('name')->get(),
        );
    }
}
