<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function defaultUser(): User
    {
        return User::factory()->create();
    }

    protected function enabledUser(): User
    {
        return User::factory()->enabled()->create();
    }
}
