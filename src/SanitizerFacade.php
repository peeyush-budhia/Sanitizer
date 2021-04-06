<?php

namespace PeeyushBudhia\Sanitizer;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PeeyushBudhia\Sanitizer\Skeleton\SkeletonClass
 */
class SanitizerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sanitizer';
    }
}
