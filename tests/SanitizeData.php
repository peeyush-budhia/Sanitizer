<?php

namespace Peeyush\Sanitizer\Tests;

use Peeyush\Sanitizer\Sanitizer;

trait SanitizeData
{
    /**
     * Sanitizes the data.
     *
     * @param array $data
     * @param array $data
     * @return array
     */
    public function sanitize(array $data, array $filters)
    {
        $sanitizer = new Sanitizer($data, $filters);

        return $sanitizer->sanitize();
    }
}
