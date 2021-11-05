<?php

namespace App\Filters;

class Criteria
{
    private mixed $value;

    public function __construct(mixed $value)
    {
        $this->value = $value;
    }

    public function value(): mixed
    {
        return $this->value;
    }

    public function __toString(): string
    {
        if (!isset($this->value) || empty($this->value)) {
            return '';
        }

        if (is_array($this->value)) {
            return implode(',', $this->value);
        }

        return $this->value;
    }
}
