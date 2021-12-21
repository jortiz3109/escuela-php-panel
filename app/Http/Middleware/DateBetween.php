<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DateBetween
{
    public function handle(Request $request, Closure $next)
    {
        if ($dates = $request->input('filters.dates')) {
            $request->merge([
                'filters' => array_replace($request->input('filters'), [
                    'dates' => explode(' - ', $dates),
                ]),
            ]);
        }

        return $next($request);
    }
}
