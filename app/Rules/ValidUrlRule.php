<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ValidUrlRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        return is_array($parsed = parse_url($value)) && $this->handle($parsed);
    }

    private function handle(array $segments): bool
    {
        return ($scheme = Arr::get($segments, 'scheme'))
            && (Str::is($scheme, 'http') || Str::is($scheme, 'https'))
            && !Arr::has($segments, 'port')
            && !Arr::has($segments, 'user')
            && !Arr::has($segments, 'pass')
            && !Arr::has($segments, 'query')
            && !Arr::has($segments, 'fragment')
            && ($host = Arr::get($segments, 'host'))
            && !filter_var($host, FILTER_VALIDATE_IP);
    }

    public function message(): string
    {
        return trans('validation.url');
    }
}
