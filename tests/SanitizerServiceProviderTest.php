<?php

namespace Peeyush\Sanitizer\Tests;

use Peeyush\Sanitizer\SanitizerServiceProvider;
use PHPUnit\Framework\TestCase;

class SanitizerServiceProviderTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [SanitizerServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
