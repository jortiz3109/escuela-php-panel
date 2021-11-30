<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CountryComposer
{
    public function compose(View $view): void
    {
        $view->with(
            'countries',
            DB::table('countries')->select('name', 'alpha_two_code')->orderBy('name')->get(),
        );
    }
}
