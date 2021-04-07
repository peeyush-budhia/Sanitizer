<?php

namespace Peeyush\Sanitizer\Filters;

use Peeyush\Sanitizer\Contracts\Filter;

class Digit implements Filter
{
    /**
     * Get only digit characters from the string.
     *
     * @param mixed $value
     * @return mixed
     */
    public function apply($value, $options = [])
    {
        return preg_replace('/[^0-9]/si', '', $value);
    }
}
