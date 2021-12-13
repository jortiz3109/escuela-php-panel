<?php

namespace Tests\Support\User;

trait UserUnitDataProvider
{
    public function userStatusDataProvider(): array
    {
        return [
            'user has enabled status' => [
                'status' => 'enabled',
                'value' => true,
            ],
            'user has disabled status' => [
                'status' => 'disabled',
                'value' => false,
            ],
        ];
    }

    public function userEmailVerifyDataProvider(): array
    {
        return [
            'user has enabled status' => [
                'status' => 'verified',
                'value' => true,
            ],
            'user has disabled status' => [
                'status' => 'unverified',
                'value' => false,
            ],
        ];
    }
}
