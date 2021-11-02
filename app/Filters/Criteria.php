<?php

namespace App\Filters;

class Criteria
{
    private string|array $value;

    public function __construct(string|array|int $value)
    {
        $this->value = $value;
    }

    public function value(): string|array
    {
        return $this->value;
    }

    public function __toString(): string
    {
        if (is_array($this->value)) {
            return implode(',', $this->value);
        }

        return $this->value;
    }

}
