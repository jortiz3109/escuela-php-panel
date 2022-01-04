<?php

namespace Tests\Concerns;

use Illuminate\Support\Str;

trait PermissionHasDataProvider
{
    protected function validPermissionData(): array
    {
        return [
            'name' => 'valid.name',
            'description' => 'valid.description',
        ];
    }

    public function validationFilterProvider(): array
    {
        return [
            'name min' => ['attribute' => 'name', 'value' => 'f'],
            'name max' => ['attribute' => 'name', 'value' => Str::random(126)],
        ];
    }

    public function validationFieldsProvider(): array
    {
        return [
            'description is missing' => [
                'description',
                ['description' => null],
            ],
            'description is not a string' => [
                'description',
                ['description' => ['description']],
            ],
            'description is too short' => [
                'description',
                ['description' => 'a'],
            ],
            'description is too long' => [
                'description',
                ['description' => Str::random(256)],
            ],
        ];
    }
}
