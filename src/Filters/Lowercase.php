<?php

namespace Peeyush\Sanitizer\Filters;

use Peeyush\Sanitizer\Contracts\Filter;

class Lowercase implements Filter
{
    /**
     * Lowercase the given string.
     *
     * @param mixed $value
     * @return mixed
     */
    public function apply($value, $options = [])
    {
        return is_string($value) ? mb_strtolower($value, 'UTF-8') : $value;
    }
}
