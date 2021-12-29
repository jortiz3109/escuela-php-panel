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
        $validData = $this->validPermissionData();

        return [
            'name is missing' => [
                'name',
                array_replace($validData, ['name' => null]),
            ],
            'name is not a string' => [
                'name',
                array_replace($validData, ['name' => ['name']]),
            ],
            'name is too short' => [
                'name',
                array_replace($validData, ['name' => 'a']),
            ],
            'name is too long' => [
                'name',
                array_replace($validData, ['name' => Str::random(126)]),
            ],
            'description is missing' => [
                'description',
                array_replace($validData, ['description' => null]),
            ],
            'description is not a string' => [
                'description',
                array_replace($validData, ['description' => ['description']]),
            ],
            'description is too short' => [
                'description',
                array_replace($validData, ['description' => 'a']),
            ],
            'description is too long' => [
                'description',
                array_replace($validData, ['description' => Str::random(256)]),
            ],
        ];
    }
}
