<?php

namespace Peeyush\Sanitizer\Filters;

use Peeyush\Sanitizer\Contracts\Filter;

class Capitalize implements Filter
{
    /**
     * Capitalize the given string.
     *
     * @param mixed $value
     * @return mixed
     */
    public function apply($value, $options = [])
    {
        return is_string($value) ? mb_convert_case(mb_strtolower($value, 'UTF-8'),  MB_CASE_TITLE) : $value;
    }
}
