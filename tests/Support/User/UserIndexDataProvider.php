<?php

namespace Tests\Support\User;

trait UserIndexDataProvider
{
    public function hasFilteredStatusDataProvider(): array
    {
        return [
            'has filtered by enabled status' => [
                'enabled' => 5,
                'disabled' => 15,
                'filter_by' => 'enabled',
                'filtered_data' => 8,
            ],
            'has filtered by disabled status' => [
                'enabled' => 5,
                'disabled' => 10,
                'filter_by' => 'disabled',
                'filtered' => 10,
            ],
        ];
    }

    public function userFilterDataProvider(): array
    {
        return [
            'filter user by created at' => [
                'filters' => [
                    'email' => 'filter@test.com',
                    'created_at' => '2021-11-12',
                    'enabled_at' => null,
                ],
                'user_data_creation' => [
                    'name' => 'test',
                    'email' => 'filter@test.com',
                    'created_at' => '12-11-2021',
                    'enabled_at' => null,
                ],
            ],
        ];
    }

    public function filtersProvider(): array
    {
        return [
            ['data' => ['attribute' => 'name', 'filterValue' => 'Roberto Jimenez']],
            ['data' => ['attribute' => 'email', 'filterValue' => 'rcjimenez35@gmail.com']],
        ];
    }
}
