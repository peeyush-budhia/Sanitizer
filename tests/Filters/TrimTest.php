<?php

namespace Peeyush\Sanitizer\Tests\Unit\Filters;

use Peeyush\Sanitizer\Tests\SanitizeData;
use PHPUnit\Framework\TestCase;

class TrimTest extends TestCase
{
    use SanitizeData;

    public function test_trims_strings()
    {
        $data = [
            'name' => '  Peeyush  ',
        ];
        $filters = [
            'name' => 'trim',
        ];
        $data = $this->sanitize($data, $filters);

        $this->assertEquals('Peeyush', $data['name']);
    }
}
