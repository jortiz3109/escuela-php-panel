<?php

namespace Tests\Unit\Filters;

use App\Filters\Criteria;
use PHPUnit\Framework\TestCase;

class CriteriaTest extends TestCase
{
    public function test_it_returns_the_criteria_value()
    {
        $criteria = new Criteria('a value');
        $this->assertSame('a value', $criteria->value());
    }

    public function test_it_returns_an_empty_string_when_received_a_null_value()
    {
        $criteria = new Criteria(null);
        $this->assertSame('', (string)$criteria);
    }

    public function test_it_returns_a_comma_separate_string_when_received_an_array()
    {
        $criteria = new Criteria(['A' , 'B', 'C']);
        $this->assertSame('A,B,C', (string)$criteria);
    }
}
