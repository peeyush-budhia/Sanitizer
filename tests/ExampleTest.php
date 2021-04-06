<?php

namespace PeeyushBudhia\Sanitizer\Tests;

use Orchestra\Testbench\TestCase;
use PeeyushBudhia\Sanitizer\SanitizerServiceProvider;

class ExampleTest extends TestCase
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
