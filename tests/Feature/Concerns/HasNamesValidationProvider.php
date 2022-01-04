<?php

namespace Tests\Feature\Concerns;

use Illuminate\Support\Str;

trait HasNamesValidationProvider
{
    public function namesValidationProvider(): array
    {
        return [
            'name min' => ['attribute' => 'name', 'value' => 'f'],
            'name max' => ['attribute' => 'name', 'value' => Str::random(126)],
        ];
    }
}
