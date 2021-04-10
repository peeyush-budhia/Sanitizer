<?php

namespace Peeyush\Sanitizer\Tests\Filters;

use Peeyush\Sanitizer\Tests\SanitizeData;
use PHPUnit\Framework\TestCase;

class DigitTest extends TestCase
{
    use SanitizeData;

    public function test_string_to_digits()
    {
        $data = [
            'name' => '+00(000)00-000-00d',
        ];
        $filters = [
            'name' => 'digit',
        ];
        $data = $this->sanitize($data, $filters);

        $this->assertEquals('000000000000', $data['name']);
    }

    public function test_string_to_digits2()
    {
        $data = [
            'name' => 'Qwe-rty!:)',
        ];
        $filters = [
            'name' => 'digit',
        ];
        $data = $this->sanitize($data, $filters);

        $this->assertEquals('', $data['name']);
    }
}
