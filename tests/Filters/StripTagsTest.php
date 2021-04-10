<?php

namespace Peeyush\Sanitizer\Tests\Unit\Filters;

use Peeyush\Sanitizer\Tests\SanitizeData;
use PHPUnit\Framework\TestCase;

class StripTagsTest extends TestCase
{
    use SanitizeData;

    public function test_trims_strings()
    {
        $data = [
            'name' => '<p>Test paragraph.</p><!-- Comment --> <a href="#fragment">Other text</a>',
        ];
        $filters = [
            'name' => 'strip_tags',
        ];
        $data = $this->sanitize($data, $filters);

        $this->assertEquals('Test paragraph. Other text', $data['name']);
    }
}
