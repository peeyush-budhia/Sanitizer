<?php

namespace Peeyush\Sanitizer\Tests\Unit\Filters;

use Peeyush\Sanitizer\Tests\SanitizeData;
use PHPUnit\Framework\TestCase;

class FormatDateTest extends TestCase
{
    use SanitizeData;

    public function test_formats_dates()
    {
        $data = [
            'date' => '21/03/1983',
        ];
        $filters = [
            'date' => 'format_date:d/m/Y, Y-m-d',
        ];
        $data = $this->sanitize($data, $filters);

        $this->assertEquals('1983-03-21', $data['date']);
    }

    public function test_requires_two_arguments()
    {
        $this->expectException(\InvalidArgumentException::class);

        $data = [
            'date' => '21/03/1983',
        ];
        $filters = [
            'date' => 'format_date:d/m/Y',
        ];
        $data = $this->sanitize($data, $filters);
    }
}
