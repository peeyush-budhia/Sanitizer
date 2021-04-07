<?php

namespace Peeyush\Sanitizer\Filters;

use Peeyush\Sanitizer\Contracts\Filter;

class StripTags implements Filter
{
    /**
     * Strip tags from the given string.
     *
     * @param mixed $value
     * @return mixed
     */
    public function apply($value, $options = [])
    {
        return is_string($value) ? strip_tags($value) : $value;
    }
}
