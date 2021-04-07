<?php

namespace Peeyush\Sanitizer\Filters;

use Peeyush\Sanitizer\Contracts\Filter;

class Trim implements Filter
{
    /**
     * Trims the given string.
     *
     * @param mixed $value
     * @return mixed
     */
    public function apply($value, $options = [])
    {
        return is_string($value) ? trim($value) : $value;
    }
}
