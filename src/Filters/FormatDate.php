<?php

namespace Peeyush\Sanitizer\Filters;

use Carbon\Carbon;
use Peeyush\Sanitizer\Contracts\Filter;

class FormatDate implements Filter
{
    /**
     * Format data.
     *
     * @param mixed $value
     * @return mixed
     */
    public function apply($value, $options = [])
    {
        if (!$value) {
            return $value;
        }
        if (sizeof($options) != 2) {
            throw new \InvalidArgumentException('The Sanitizer Format Date filter requires both the current date format as well as the target format.');
        }
        $currentFormat = trim($options[0]);
        $targetFormat = trim($options[1]);
        return Carbon::createFromFormat($currentFormat, $value)->format($targetFormat);
    }
}
