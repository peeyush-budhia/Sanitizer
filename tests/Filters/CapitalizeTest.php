<?php

namespace Peeyush\Sanitizer\Tests\Filters;

use Peeyush\Sanitizer\Tests\SanitizeData;
use PHPUnit\Framework\TestCase;

class CapitalizeTest extends TestCase
{
    use SanitizeData;
    public function test_capitalizes_strings()
    {
        $result = $this->sanitize(['name' => 'peeyush'], ['name' => 'capitalize']);
        $this->assertEquals('Peeyush', $result['name']);
    }

    public function test_capitalizes_special_characters()
    {
        $result = $this->sanitize(['name' => 'Τάχιστη αλώπηξ'], ['name' => 'capitalize']);
        $this->assertEquals('Τάχιστη Αλώπηξ', $result['name']);
    }
}
