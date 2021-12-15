<?php

namespace Tests\Support\User;

trait UserIndexDataProvider
{
    public function makeFilter(string $status, int $amount)
    {
        return [
            'status' => $status,
            'count' => $amount,
        ];
    }

    public function hasFilteredStatusDataProvider()
    {
        return [
            'has filtered by enabled status' => [
                'enabled' => $this->makeFilter('enabled', 5),
                'disabled' => $this->makeFilter('disabled', 15),
                'filter_by' => 'enabled',
                'filtered_data' => 5,
            ],
            'has filtered by disabled status' => [
                'enabled' => $this->makeFilter('enabled', 5),
                'disabled' => $this->makeFilter('disabled', 10),
                'filter_by' => 'disabled',
                'filtered' => 11,
            ],
        ];
    }


    public function userProvider(): array
    {
        return [
            'user_data' => [
                'name' => 'Roberto Jimenez',
                'email' => 'rcjimenez35@gmail.com',
                'enabled_at' => null,
                'created_at' => '12-11-2021',
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
