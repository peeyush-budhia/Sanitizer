<?php

namespace Peeyush\Sanitizer;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Peeyush\Sanitizer\Skeleton\SkeletonClass
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
