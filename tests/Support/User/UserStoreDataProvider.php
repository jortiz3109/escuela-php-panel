<?php

namespace Tests\Support\User;

trait UserStoreDataProvider
{

    public function invalidUserData(): array
    {
        return [
            'empty name' => [
                'name',
                array_merge($this->userData(), ['name' => ''])
            ],
            'numeric values in name' => [
                'name',
                array_merge($this->userData(), ['name' => '2313'])
            ],
            'no alphabetic spaces name' => [
                'name',
                array_merge($this->userData(), ['name' => 'test_name'])
            ],
            'empty email' => [
                'email',
                array_merge($this->userData(), ['email' => ''])
            ],
            'duplicated email' => [
                'email',
                array_merge($this->userData(), ['email' => 'test@test.com'])
            ],
            'invalid email' => [
                'email',
                array_merge($this->userData(), ['email' => 'testtest.com'])
            ],
            'empty password' => [
                'password',
                array_merge($this->userData(), ['password' => ''])
            ],
            'too short password' => [
                'password',
                array_merge($this->userData(), ['password' => '1'])
            ],
            'require password confirmation' => [
                'password',
                array_merge($this->userData(), ['password_confirmation' => ''])
            ],
        ];
    }

    public function userData()
    {
        return [
            'name' => 'Test Name',
            'email' => 'userTest@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];
    }

}
