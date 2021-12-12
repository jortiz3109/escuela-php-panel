<?php

namespace Tests;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use ReflectionClass;
use ReflectionException;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function defaultUser(): Model
    {
        return User::factory()->create();
    }

    protected function enabledUser(): User
    {
        return User::factory()->enabled()->create();
    }

    /**
     * @throws ReflectionException
     */
    protected function getReflectionProtectedPropertyValue(string $className, string $property): mixed
    {
        $reflector = new ReflectionClass($className);
        $property = $reflector->getProperty($property);
        $property->setAccessible(true);

        return $property->getValue(new $className());
    }
}
