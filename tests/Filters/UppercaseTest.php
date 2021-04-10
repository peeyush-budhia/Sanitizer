<?php

namespace Peeyush\Sanitizer\Tests\Unit\Filters;

use Peeyush\Sanitizer\Tests\SanitizeData;
use PHPUnit\Framework\TestCase;

class UppercaseTest extends TestCase
{
    use SanitizeData;

    public function test_uppercases_strings()
    {
        $data = [
            'name' => 'pEEyush bUdhia',
        ];
        $filters = [
            'name' => 'uppercase',
        ];
        $data = $this->sanitize($data, $filters);

        $this->assertEquals('PEEYUSH BUDHIA', $data['name']);
    }

    public function test_uppercases_special_characters_strings()
    {
        $data = [
            'name' => 'Τάχιστη αλώπηξ',
        ];
        $filters = [
            'name' => 'uppercase',
        ];
        $data = $this->sanitize($data, $filters);

        $this->assertEquals('ΤΆΧΙΣΤΗ ΑΛΏΠΗΞ', $data['name']);
    }
}
