<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use ReflectionClass;
use ReflectionException;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

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
