<?php

namespace Tests\Support;

trait UserDataProvider
{
    protected string $name = 'test';
    protected string $email = 'test@test.com';
    protected string $password = 'password';
    protected string $invalid = '';

    public function getAttributes(
        string $name,
        string $email,
        string $password
    ): array {
        return [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ];
    }

    public function validUserData(): array
    {
        return [
            'valid data for user creation' => [
                'data' => $this->getAttributes($this->name, $this->email, $this->password),
            ],
        ];
    }

    public function validUserStatusData(): array
    {
        return [
            'disabled user' => [
                'data' => $this->getAttributes($this->name, $this->email, $this->password),
                'status' => [
                    'value' => null,
                    'function' => 'disabled',
                ],
            ],
        ];
    }

    public function invalidUserData(): array
    {
        return [
            'empty name for user creation' => [
                'data' => $this->getAttributes($this->invalid, $this->email, $this->password),
                'field' => 'name',
            ],
            'invalid name for user creation' => [
                'data' => $this->getAttributes('test90', $this->email, $this->password),
                'field' => 'name',
            ],
            'empty email for user creation' => [
                'data' => $this->getAttributes($this->name, $this->invalid, $this->password),
                'field' => 'email',
            ],
            'empty password for user creation' => [
                'data' => $this->getAttributes($this->name, $this->email, $this->invalid),
                'field' => 'password',
            ],
        ];
    }
}
