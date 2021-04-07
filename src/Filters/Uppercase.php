<?php

namespace Peeyush\Sanitizer\Filters;

use Peeyush\Sanitizer\Contracts\Filter;

class Uppercase implements Filter
{
    /**
     * Uppercase the given string.
     *
     * @param mixed $value
     * @return mixed
     */
    public function apply($value, $options = [])
    {
        return is_string($value) ? mb_strtoupper($value) : $value;
    }
}
