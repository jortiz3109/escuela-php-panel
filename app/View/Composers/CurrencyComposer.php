<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CurrencyComposer
{
    public function compose(View $view): void
    {
        $view->with(
            'currencies',
            DB::table('currencies')->select('name', 'alphabetic_code')->orderBy('name')->get(),
        );
    }
}
